export default function Counter(){
    return <div className="flex md:flex-col flex-row items-center justify-between bg-[#F5F6FA] rounded-md text-[#8e8dcf] transition- delay-300 hover:delay-300 hover:text-[#5C5BB2] font-bold text-base">
        <button className="w-9 h-8">+</button>
        <input type="number" disabled className="bg-transparent text-center h-8 w-9 text-[#5C5BB2]" value={0}/>
        <button className="w-9 h-8">-</button>
    </div>  
}