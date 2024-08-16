import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useTranslation } from "react-i18next";
import { format, parseISO } from "date-fns";

interface Diary {
    id: number;
    user_id: number;
    language_id: number;
    jp_text: string;
    trans_text: string;
    created_at: string;
}

interface DiaryPageProps extends PageProps {
    diaries: Diary[];
}

export default function Register({ auth, diaries }: DiaryPageProps) {
    const { t } = useTranslation();

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Diary History List")}
                </h2>
            }
        >
            <Head title={t("Diary History List")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {diaries.length > 0 ? (
                                <div className="grid grid-cols-1 gap-4">
                                    <div className="hidden md:grid md:grid-cols-[1fr_6fr_6fr_3fr] md:gap-4 font-bold text-sm uppercase tracking-wider text-gray-500 dark:text-gray-400 pb-2 border-b border-gray-200 dark:border-gray-700">
                                        <div>{t("ID")}</div>
                                        <div>{t("Japanese Text")}</div>
                                        <div>{t("Translation Text")}</div>
                                        <div>{t("Created at")}</div>
                                    </div>
                                    {diaries.map((diary, index) => (
                                        <div className="grid md:grid-cols-[1fr_6fr_6fr_3fr] gap-4 items-center py-3 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-150 ease-in-out">
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("ID")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    <Link
                                                        href={route(
                                                            "diary.show",
                                                            diary.id
                                                        )}
                                                        className="text-blue-600 hover:text-blue-800 hover:underline"
                                                    >
                                                        {index + 1}
                                                    </Link>
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Japanese Text")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {diary.jp_text}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Translation Text")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {diary.trans_text}
                                                </div>
                                            </div>
                                            <div className="flex items-center md:block">
                                                <div className="font-medium text-gray-900 md:hidden">
                                                    {t("Created at")}：
                                                </div>
                                                <div className="text-gray-900">
                                                    {format(
                                                        parseISO(
                                                            diary.created_at
                                                        ),
                                                        "yyyy/MM/dd HH:mm:ss"
                                                    )}
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            ) : (
                                <div>{t("No registered diaries")}</div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
