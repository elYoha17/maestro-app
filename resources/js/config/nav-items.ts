import { LayoutGrid, Shield } from 'lucide-react';
import { home } from '@/routes';
import { edit as editRoles } from '@/routes/roles';
import type { NavItem, RoleName } from '@/types';

export const navItemsByRole: Record<RoleName, NavItem[]> = {
    admin: [
        {
            title: 'Accueil',
            href: home(),
            icon: LayoutGrid,
            activeBase: '/',
        },
        {
            title: 'Roles',
            href: editRoles(),
            icon: Shield,
            activeBase: '/settings/roles',
        },
    ],
    manager: [
        {
            title: 'Accueil',
            href: home(),
            icon: LayoutGrid,
            activeBase: '/',
        },
    ],
};

export const defaultNavItems: NavItem[] = [
    {
        title: 'Accueil',
        href: home(),
        icon: LayoutGrid,
        activeBase: '/',
    },
];

export const defaultNavLabel = 'Navigation';
