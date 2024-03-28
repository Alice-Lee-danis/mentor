import { createContext, useState } from "react";
import { RaitingContent } from "./content/raitingContent";
import SelectContent from "./content/selectContent";

export const context = createContext<Object>("as"); 

export default function Popup(){

    const[stateRaiting, setStateRaiting] = useState<Number>(0);
    const[stateEnterRaiting, setStateEnterRaiting] = useState<Boolean>(true);

    return <div className="bg-d-blue w-[25rem] h-[26rem] text-white rounded-3xl p-8 ">
        <context.Provider value={[setStateRaiting, setStateEnterRaiting, stateRaiting, stateRaiting]}> 
            {
                stateEnterRaiting && <RaitingContent ratingScaleLength={5}/> || !stateEnterRaiting && <SelectContent/>}
        </context.Provider>
    </div>
}