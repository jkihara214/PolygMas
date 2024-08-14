import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useTranslation } from "react-i18next";
import { format, parseISO } from "date-fns";

interface User {
    id: number;
    name: string;
    email: string;
    created_at: string;
}

interface UserPageProps extends PageProps {
    users: User[];
}

export default function Register({ auth, users }: UserPageProps) {
    const { t } = useTranslation();

    return (
        <AdminAuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("User List")}
                </h2>
            }
        >
            <Head title={t("User List")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {users.length > 0 ? (
                                <div className="grid grid-cols-1 gap-4">
                                    <div className="hidden md:grid md:grid-cols-[1fr_3fr_4fr_3fr] md:gap-4 font-bold text-sm uppercase tracking-wider text-gray-500 dark:text-gray-400 pb-2 border-b border-gray-200 dark:border-gray-700">
                                        <div>{t("ID")}</div>
                                        <div>{t("Name")}</div>
                                        <div>{t("Email")}</div>
                                        <div>{t("Created at")}</div>
                                    </div>
                                    {users.map((user) => (
                                        <div className="grid md:grid-cols-[1fr_3fr_4fr_3fr] gap-4 items-center py-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("ID")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {user.id}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Name")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {user.name}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Email")}：
                                                </div>
                                                <div className="text-gray-900 break-all">
                                                    {user.email}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Created at")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {format(
                                                        parseISO(
                                                            user.created_at
                                                        ),
                                                        "yyyy/MM/dd HH:mm:ss"
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div>{t("No registered users")}</div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AdminAuthenticatedLayout>
    );
}
