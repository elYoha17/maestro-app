import type { InertiaLinkProps } from '@inertiajs/react';
import type { LucideIcon } from 'lucide-react';

export type NavItem = {
    title: string;
    href: NonNullable<InertiaLinkProps['href']>;
    icon?: LucideIcon | null;
    activeBase?: string;
    isActive?: boolean;
};

export type ResolvedNavItem = NavItem & {
    activeBase: string;
    isActive: boolean;
};
