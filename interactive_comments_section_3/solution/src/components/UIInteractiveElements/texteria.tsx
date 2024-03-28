export function Texteria(){
    return  <textarea name="" id="" className="resize-none overflow-hidden border-black border-[1px] 
    outline-none w-full min-h-[100px] rounded-xl py-5 px-6 contenteditable h-auto" onInput={(e:React.ChangeEvent<HTMLTextAreaElement>)=>{
        e.target.style.height = e.target.scrollHeight - 13 + 'px'
    }}></textarea>
}