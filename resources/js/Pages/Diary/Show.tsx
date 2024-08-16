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
    diary: Diary;
}

export default function Show({ auth, diary }: DiaryPageProps) {
    const { t } = useTranslation();

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Diary History Detail")}
                </h2>
            }
        >
            <Head title={t("Diary History Detail")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {diary ? (
                                <div className="space-y-8">
                                    <div className="border-b pb-4">
                                        <h3 className="text-lg font-semibold mb-2">
                                            {t("Japanese Text")}
                                        </h3>
                                        <p className="text-gray-700 whitespace-pre-wrap">
                                            {diary.jp_text}
                                        </p>
                                    </div>
                                    <div className="border-b pb-4">
                                        <h3 className="text-lg font-semibold mb-2">
                                            {t("Translation Text")}
                                        </h3>
                                        <p className="text-gray-700 whitespace-pre-wrap">
                                            {diary.trans_text}
                                        </p>
                                    </div>
                                    <div>
                                        <h3 className="text-lg font-semibold mb-2">
                                            {t("Created at")}
                                        </h3>
                                        <p className="text-gray-700">
                                            {format(
                                                parseISO(diary.created_at),
                                                "yyyy/MM/dd HH:mm:ss"
                                            )}
                                        </p>
                                    </div>
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
