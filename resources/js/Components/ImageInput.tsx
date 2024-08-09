import {
    forwardRef,
    useEffect,
    useImperativeHandle,
    useRef,
    InputHTMLAttributes,
} from "react";

interface ImageInputProps
    extends Omit<InputHTMLAttributes<HTMLInputElement>, "type"> {
    isFocused?: boolean;
}

export default forwardRef<HTMLInputElement, ImageInputProps>(
    function ImageInput(
        { className = "", isFocused = false, ...props }: ImageInputProps,
        ref
    ) {
        const localRef = useRef<HTMLInputElement>(null);

        useImperativeHandle(ref, () => ({
            focus: () => localRef.current?.focus(),
        }));

        useEffect(() => {
            if (isFocused) {
                localRef.current?.focus();
            }
        }, []);

        return (
            <input
                {...props}
                type="file"
                accept="image/*"
                className={
                    "block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100" +
                    className
                }
                ref={localRef}
            />
        );
    }
);
