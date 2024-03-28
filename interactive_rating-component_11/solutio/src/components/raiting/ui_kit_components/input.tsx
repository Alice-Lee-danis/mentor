export function Input({element, onInput}:{element:string, onInput:Function}){
    return <>
        <input type="radio" id={element} name='radioGroup' className='peer hidden'
                                    value={element}
                                    onInput={(e:React.MouseEvent<HTMLInputElement>)=>{
                                        e.preventDefault()
                                        onInput()
                                    }}
                                />
        <label htmlFor={element} className='bg-m-grey w-12 h-12 rounded-[50%] flex justify-center decoration items-center cursor-pointer peer-checked:bg-l-grey hover:bg-orange transition'>
            <span>{element}</span>    
        </label>   
    </>
}