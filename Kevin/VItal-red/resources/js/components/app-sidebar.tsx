import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { LayoutGrid, Users, Shield, FileText, Search, Brain, Inbox } from 'lucide-react';
import AppLogo from './app-logo';

// Navegación para Administrador
const adminNavItems: NavItem[] = [
    {
        title: 'Tablero',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Gestión de Usuarios',
        href: '/admin/usuarios',
        icon: Users,
    },
    {
        title: 'Panel de Supervisión',
        href: '/admin/supervision',
        icon: Shield,
    },
    {
        title: 'Dashboard de IA',
        href: '/admin/ia/dashboard',
        icon: Brain,
    },
];

// Navegación para Médico
const medicoNavItems: NavItem[] = [
    {
        title: 'Bandeja de Casos',
        href: '/medico/bandeja-casos',
        icon: Inbox,
    },
    {
        title: 'Ingresar Registro',
        href: '/medico/ingresar-registro',
        icon: FileText,
    },
    {
        title: 'Consulta Pacientes',
        href: '/medico/consulta-pacientes',
        icon: Search,
    },
];

export function AppSidebar() {
    const { auth } = usePage<SharedData>().props;
    const user = auth.user;

    // Determinar qué navegación mostrar según el rol
    const navItems = user.role === 'administrador' ? adminNavItems : medicoNavItems;

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={navItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
