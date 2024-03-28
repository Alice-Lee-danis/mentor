import { ReactElement } from "react"
import avatar from "../../../assets/image-amyrobson.png"
import { Button } from "../../UIInteractiveElements/button"
import { Texteria } from "../../UIInteractiveElements/texteria"
import { Avatar } from "../../UIInteractiveElements/avatar"

export default function SendForm({children}:{children:ReactElement | string}){
    return  <form action="" className="min-h-[135px] w-full p-6 rounded-2xl bg-white flex 
    md:justify-around justify-between md:flex-nowrap flex-wrap relative text-sm gap-y-6 mt-3 gap-6"
    onChange={(e:React.ChangeEvent<HTMLFormElement>)=>{
        e.preventDefault()
    }}
    >
        <div className="w-10"><Avatar image={avatar}></Avatar></div>
        <Texteria></Texteria>
        <Button>{children}</Button>
    </form>
}