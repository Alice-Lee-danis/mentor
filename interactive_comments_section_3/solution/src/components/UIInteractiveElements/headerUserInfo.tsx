import avatar from "../../assets/image-amyrobson.png"
import { Avatar } from "./avatar";

export default function HeaderUserInfo(){
    return <div className="inline-flex gap-4 items-center">
        <Avatar image={avatar}></Avatar>
        {true && <div className="py-[1px] px-2 text-white bg-blue-400 text-xs">you</div>}
        <p className="font-bold">asasasa</p>
        <p className="text-sm">20 ago</p>
</div>
}