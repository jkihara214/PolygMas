import i18n from "i18next";
import { initReactI18next } from "react-i18next";

import jaTranslations from "../../lang/ja.json";

i18n.use(initReactI18next).init({
    resources: {
        ja: { translation: jaTranslations },
    },
    lng: "ja",
    fallbackLng: "en",
    interpolation: {
        escapeValue: false,
    },
});

export default i18n;
