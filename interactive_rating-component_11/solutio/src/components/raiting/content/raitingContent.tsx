import { useContext, useMemo } from 'react';
import star from '../../../assets/icon-star.svg'
import { Button } from '../ui_kit_components/button'
import { Input } from '../ui_kit_components/input'
import { context } from '../popup';

export function RaitingContent({ratingScaleLength}:{ratingScaleLength:number}){

    const [setStateRaitin, setStateEnterRaiting, stateRaiting] : any= useContext(context);
    const ratingScale = useMemo(() => {
        return new Array(ratingScaleLength).fill(1).map((element, index:number)=>{
            return index+element
        })
    }, [ratingScaleLength]);
    return <div className='flex flex-col justify-around h-full'>
         <img src={star} alt="icon-star" className='bg-m-grey rounded-[50%] object-scale-down w-11 h-11'/>
            <h1 className='font-medium text-[25px] '>How did we do?</h1>
            <p className='text-s-card text-l-grey'>Please let us know how we did with your support request. All feedback is appreciated to help us improve our offering! </p>
            <ul className='flex justify-between'>
                {
                    ratingScale.map(element => {
                        return <li key={element}>
                            <Input key={element} element={element.toString()} onInput={()=>{
                               setStateRaitin(element)
                            }}></Input>
                        </li>
                    })
                }
            </ul>
           <Button onClick={()=>{
                if(stateRaiting)
                    setStateEnterRaiting((e:Boolean)=>!e)
           }}>submit</Button>
    </div>
}