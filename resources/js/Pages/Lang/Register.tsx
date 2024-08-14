import { FormEventHandler } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
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

interface FormData {
    language_id: number;
}

export default function Register({ auth, languages }: LanguagePageProps) {
    const { t } = useTranslation();
    const { data, setData, patch, processing, errors, reset } =
        useForm<FormData>({
            language_id: auth.user.language_id,
        });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        patch(route("lang.setting.register"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Learnig Language Setting")}
                </h2>
            }
        >
            <Head title={t("Learnig Language Setting")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            {languages.length > 0 ? (
                                <form onSubmit={submit}>
                                    <div>
                                        <InputLabel
                                            htmlFor="language_id"
                                            value={t("Language")}
                                        />

                                        <select
                                            id="language_id"
                                            name="language_id"
                                            value={data.language_id}
                                            onChange={(e) =>
                                                setData(
                                                    "language_id",
                                                    Number(e.target.value)
                                                )
                                            }
                                            className="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                            required
                                        >
                                            <option value="">
                                                {t("Select a language")}
                                            </option>
                                            {languages.map((language) => (
                                                <option
                                                    key={language.id}
                                                    value={language.id}
                                                >
                                                    {language.jp_name}
                                                </option>
                                            ))}
                                        </select>

                                        <InputError
                                            message={errors.language_id}
                                            className="mt-2"
                                        />
                                    </div>

                                    <div className="flex items-center justify-end mt-4">
                                        <PrimaryButton
                                            className="ms-4"
                                            disabled={processing}
                                        >
                                            {t("Register")}
                                        </PrimaryButton>
                                    </div>
                                </form>
                            ) : (
                                <div>{t("No registered languages")}</div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
