import { Head, usePage } from '@inertiajs/react';
import RoleCard from '@/components/role-card';
import { PlaceholderPattern } from '@/components/ui/placeholder-pattern';
import { edit } from '@/routes/roles';
import type { Role } from '@/types';

type Props = {
    roles: Role[];
};

export default function Roles({ roles }: Props) {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="Accueil" />
            <div className="flex h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
                <div className="grid auto-rows-min gap-4 md:grid-cols-1">
                    {roles.map((role) => (
                        <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                            <RoleCard key={role.id} role={role} is_active={role.name === auth.role?.name} />
                        </div>
                    ))}
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                    </div>
                    <div className="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                        <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                    </div>
                </div>
                <div className="relative min-h-screen flex-1 overflow-hidden rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                    <PlaceholderPattern className="absolute inset-0 size-full stroke-neutral-900/20 dark:stroke-neutral-100/20" />
                </div>
            </div>
            {/* <Head title="Paramètres des rôles" />

            <h1 className="sr-only">Paramètres des rôles</h1>

            <div className="space-y-6">
                <Heading
                    variant="small"
                    title="Rôles disponibles"
                    description={
                        auth.role
                            ? `Vous naviguez actuellement avec le rôle ${auth.role}.`
                            : 'Activez un rôle pour naviguer avec ses droits.'
                    }
                />

                {roles.length > 0 ? (
                    <div className="grid auto-rows-min gap-4 md:grid-cols-3">
                        {roles.map((role) => (
                            <RoleCard key={role.id} role={role} is_active={role.name === auth.role} />
                        ))}
                    </div>
                ) : (
                    <div className="rounded-xl border border-dashed border-sidebar-border/70 p-6 text-sm text-muted-foreground dark:border-sidebar-border">
                        Aucun rôle n&apos;est disponible pour cet utilisateur.
                    </div>
                )}
            </div> */}
        </>
    );
}

Roles.layout = {
    breadcrumbs: [
        {
            title: 'Paramètres des rôles',
            href: edit(),
        },
    ],
};
