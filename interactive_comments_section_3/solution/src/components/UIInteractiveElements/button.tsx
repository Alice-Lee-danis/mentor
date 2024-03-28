import { ReactElement } from "react";

export function Button({children}:{children:ReactElement | string}){
    return <button className="bg-blue-700 rounded-xl h-12 w-28 float-right text-white">{children}</button>
}