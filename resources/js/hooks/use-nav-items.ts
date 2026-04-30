import { usePage } from '@inertiajs/react';
import {
    defaultNavItems,
    defaultNavLabel,
    navItemsByRole,
} from '@/config/nav-items';
import { useCurrentUrl } from '@/hooks/use-current-url';
import { toUrl } from '@/lib/utils';
import type { ResolvedNavItem, RoleName } from '@/types';

type UseNavItemsReturn = {
    items: ResolvedNavItem[];
    label: string;
    role: RoleName | null;
};

function normalizePath(path: string): string {
    if (path === '/') {
        return path;
    }

    return path.replace(/\/+$/, '');
}

function resolveActiveBase(item: {
    href: ResolvedNavItem['href'];
    activeBase?: string;
}): string {
    const href = toUrl(item.href);

    return normalizePath(item.activeBase ?? href);
}

function isNavItemActive(currentUrl: string, activeBase: string): boolean {
    if (activeBase === '/') {
        return currentUrl === '/';
    }

    return currentUrl === activeBase || currentUrl.startsWith(`${activeBase}/`);
}

export function useNavItems(): UseNavItemsReturn {
    const { auth } = usePage().props;
    const { currentUrl } = useCurrentUrl();
    const role = auth.role?.name ?? null;
    const configuredItems = role ? navItemsByRole[role] : defaultNavItems;
    const label = auth.role?.label ?? defaultNavLabel;

    const items = configuredItems.map((item) => {
        const activeBase = resolveActiveBase(item);

        return {
            ...item,
            activeBase,
            isActive: isNavItemActive(currentUrl, activeBase),
        };
    });

    return {
        items,
        label,
        role,
    };
}
