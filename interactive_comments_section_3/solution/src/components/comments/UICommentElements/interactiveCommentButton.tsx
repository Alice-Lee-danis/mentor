export function InteractiveCommentButton({children, color='red'}:{children: React.ReactElement | string, color?:string}){
   
    return <button style={{
        color:color
    }} className="order-3 text-red-500 font-bold">{children}</button>
}