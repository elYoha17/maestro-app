import { Form } from '@inertiajs/react';
import RoleController from '@/actions/App/Http/Controllers/Settings/RoleController';
import { Badge } from '@/components/ui/badge';
import { Button } from '@/components/ui/button';

type RoleCardProps = {
    role: {
        id: number;
        name: string;
        label: string;
        description: string | null;
    },
    is_active: boolean ,
};

export default function RoleCard({ role, is_active = false }: RoleCardProps) {
    return (
        <div className="relative flex aspect-video flex-col justify-between overflow-hidden rounded-xl border border-sidebar-border/70 bg-card p-5 dark:border-sidebar-border">
            <div className="space-y-4">
                <div className="flex items-start justify-between gap-3">
                    <div className="space-y-1">
                        <h3 className="text-base font-semibold tracking-tight">
                            {role.label}
                        </h3>
                    </div>

                    <Badge variant={is_active ? 'default' : 'outline'}>
                        {is_active ? 'Actif' : 'Inactif'}
                    </Badge>
                </div>

                <p className="text-sm leading-6 text-muted-foreground">
                    {role.description ?? 'Aucune description disponible.'}
                </p>
            </div>

            <div className="pt-4">
                {is_active ? (
                    <Form {...RoleController.deactivate.form()}>
                        {({ processing }) => (
                            <Button
                                type="submit"
                                variant="outline"
                                disabled={processing}
                                className="w-full"
                            >
                                Désactiver
                            </Button>
                        )}
                    </Form>
                ) : (
                    <Form {...RoleController.activate.form(role.id)}>
                        {({ processing }) => (
                            <Button
                                type="submit"
                                disabled={processing}
                                className="w-full"
                            >
                                Activer
                            </Button>
                        )}
                    </Form>
                )}
            </div>
        </div>
    );
}
