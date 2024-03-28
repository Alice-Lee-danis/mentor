
export function Button({children, onClick}:{children:React.JSX.Element | string, onClick:Function}){
    return <button className='cursor-pointer hover:bg-white hover:text-orange mt-3 bg-orange transition h-11 rounded-3xl'
            onClick={(e:React.MouseEvent<HTMLButtonElement>)=>{
                e.preventDefault()
                onClick()
            }}>
                {children}
            </button>
}