import { FormEventHandler } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useTranslation } from "react-i18next";

export default function Register({ auth }: PageProps) {
    const { t } = useTranslation();
    const { data, setData, post, processing, errors, reset } = useForm({
        diary_a1: "",
        diary_a2: "",
        diary_a3: "",
        diary_a4: "",
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("diary.register"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Automatic Diary Creation")}
                </h2>
            }
        >
            <Head title={t("Automatic Diary Creation")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <form onSubmit={submit}>
                                <div>
                                    <InputLabel
                                        htmlFor="diary_a1"
                                        value={t(
                                            "How was the weather and temperature today?"
                                        )}
                                    />

                                    <TextInput
                                        id="diary_a1"
                                        name="diary_a1"
                                        value={data.diary_a1}
                                        className="mt-1 block w-full"
                                        autoComplete="diary_a1"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData("diary_a1", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.diary_a1}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="diary_a2"
                                        value={t(
                                            "Where and what did you eat today?"
                                        )}
                                    />

                                    <TextInput
                                        id="diary_a2"
                                        name="diary_a2"
                                        value={data.diary_a2}
                                        className="mt-1 block w-full"
                                        autoComplete="diary_a2"
                                        onChange={(e) =>
                                            setData("diary_a2", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.diary_a2}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="diary_a3"
                                        value={t(
                                            "What made you happy or what made you have fun today?"
                                        )}
                                    />

                                    <TextInput
                                        id="diary_a3"
                                        name="diary_a3"
                                        value={data.diary_a3}
                                        className="mt-1 block w-full"
                                        autoComplete="diary_a3"
                                        onChange={(e) =>
                                            setData("diary_a3", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.diary_a3}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="diary_a4"
                                        value={t(
                                            "What was difficult or challenging today?"
                                        )}
                                    />

                                    <TextInput
                                        id="diary_a4"
                                        name="diary_a4"
                                        value={data.diary_a4}
                                        className="mt-1 block w-full"
                                        autoComplete="diary_a4"
                                        onChange={(e) =>
                                            setData("diary_a4", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.diary_a4}
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
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
