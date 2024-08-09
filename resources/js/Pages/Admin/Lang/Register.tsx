import { FormEventHandler } from "react";
import AdminAuthenticatedLayout from "@/Layouts/AdminAuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import ImageInput from "@/Components/ImageInput";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import { useTranslation } from "react-i18next";

export default function Register({ auth }: PageProps) {
    const { t } = useTranslation();
    const { data, setData, post, processing, errors, reset } = useForm({
        jp_name: "",
        en_name: "",
        code: "",
        image: null as File | null,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.lang.register"));
    };

    return (
        <AdminAuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    {t("Lang Register")}
                </h2>
            }
        >
            <Head title={t("Lang Register")} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <form onSubmit={submit}>
                                <div>
                                    <InputLabel
                                        htmlFor="jp_name"
                                        value={t("JP Name")}
                                    />

                                    <TextInput
                                        id="jp_name"
                                        name="jp_name"
                                        value={data.jp_name}
                                        className="mt-1 block w-full"
                                        autoComplete="jp_name"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData("jp_name", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.jp_name}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="en_name"
                                        value={t("EN Name")}
                                    />

                                    <TextInput
                                        id="en_name"
                                        name="en_name"
                                        value={data.en_name}
                                        className="mt-1 block w-full"
                                        autoComplete="en_name"
                                        onChange={(e) =>
                                            setData("en_name", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.en_name}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="code"
                                        value={t("Lang Code")}
                                    />

                                    <TextInput
                                        id="code"
                                        name="code"
                                        value={data.code}
                                        className="mt-1 block w-full"
                                        autoComplete="code"
                                        onChange={(e) =>
                                            setData("code", e.target.value)
                                        }
                                        required
                                    />

                                    <InputError
                                        message={errors.code}
                                        className="mt-2"
                                    />
                                </div>

                                <div className="mt-4">
                                    <InputLabel
                                        htmlFor="image"
                                        value={t("Country Image")}
                                    />
                                    <ImageInput
                                        id="image"
                                        name="image"
                                        className="mt-1 block w-full"
                                        onChange={(e) =>
                                            setData(
                                                "image",
                                                e.target.files
                                                    ? e.target.files[0]
                                                    : null
                                            )
                                        }
                                        required
                                    />
                                    <InputError
                                        message={errors.image}
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
        </AdminAuthenticatedLayout>
    );
}
