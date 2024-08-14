import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useTranslation } from "react-i18next";

interface Language {
    id: number;
    jp_name: string;
    en_name: string;
    code: string;
}

interface LanguagePageProps extends PageProps {
    languages: Language[];
}

export default function Register({ auth, languages }: LanguagePageProps) {
    const { t } = useTranslation();

    return (
        <AdminAuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Lang List")}
                </h2>
            }
        >
            <Head title={t("Lang List")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {languages.length > 0 ? (
                                <div className="grid grid-cols-1 gap-4">
                                    <div className="hidden md:grid md:grid-cols-4 md:gap-4 font-bold text-sm uppercase tracking-wider text-gray-500 dark:text-gray-400 pb-2 border-b border-gray-200 dark:border-gray-700">
                                        <div>{t("ID")}</div>
                                        <div>{t("JP Name")}</div>
                                        <div>{t("EN Name")}</div>
                                        <div>{t("Lang Code")}</div>
                                    </div>
                                    {languages.map((language) => (
                                        <div className="grid md:grid-cols-4 gap-4 items-center py-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("ID")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {language.id}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("JP Name")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {language.jp_name}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("EN Name")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {language.en_name}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Lang Code")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {language.code}
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div>{t("No registered languages")}</div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AdminAuthenticatedLayout>
    );
}
