import SendForm from "./UICommentElements/sendForm"
import { InteractiveCommentButton } from "./UICommentElements/interactiveCommentButton"
import { Texteria } from "../UIInteractiveElements/texteria"
import { Button } from "../UIInteractiveElements/button"
import HeaderUserInfo from "../UIInteractiveElements/headerUserInfo"
import Counter from "../UIInteractiveElements/counter"

export default function Comment(){
    return <section className="">
        <div className="min-h-[142px] w-full p-6 rounded-2xl bg-white flex 
        md:justify-start justify-between md:flex-nowrap flex-wrap relative text-sm gap-y-6">
            <div className="order-2 md:order-1">
                <Counter></Counter>
            </div>
            <div className="md:ml-4 ml-0 w-full order-1 md:order-2">
                <div className="max-w-[600px]">
                    <HeaderUserInfo></HeaderUserInfo>
                    {
                        false ? <form className="mt-3" onChange={(e:React.ChangeEvent<HTMLFormElement>)=>e}>
                            <Texteria></Texteria>
                            <div className="mt-4">
                                <Button>UPDATE</Button> 
                            </div>
                        </form> : <div>
                            <span className="text-[13px]">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores, labore. Libero, doloremque esse velit repellat quia obcaecati voluptate iusto sed! Consectetur id enim voluptas in! Sunt similique illo architecto temporibus voluptas consectetur nam fugit, provident impedit voluptates, rerum atque numquam? Molestiae, excepturi libero? Sed, explicabo vitae.</span>
                    </div>
                    }
                </div>
            </div>
            <div className="right-6 md:absolute static order-3 flex gap-2 opacity-40">
                {!true ? <InteractiveCommentButton color="blue">reply</InteractiveCommentButton> : 
                    <>
                        <InteractiveCommentButton color="red">delete</InteractiveCommentButton>
                        <InteractiveCommentButton color="blue">edit</InteractiveCommentButton>
                    </>
                }
            </div> 
        </div>
        {true && <SendForm>REPLY</SendForm>}
       
    </section>
}