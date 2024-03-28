import { useContext } from 'react';
import TnkYouIllustration from '../../../assets/illustration-thank-you.svg'
import { context } from '../popup';

export default function(){

    const [,,, stateRaiting] : any= useContext(context);

    return <div className='flex flex-col justify-around items-center h-full'>
        <img src={TnkYouIllustration} alt="illustration-thank-you" className='h-24 object-contain'/>
        <p className='bg-m-grey p-1 pl-3 pr-3 rounded-3xl text-[14px] text-orange'>you selected {stateRaiting} out of 5</p>
        <div className='text-center'>
            <h1 className='font-medium text-[25px]'>Thank you!</h1>
            <p className='text-[14px] mt-[20px] text-l-grey'>We appreciate you taking the time to give a rating. If you ever need more support, don’t hesitate to get in touch!</p>
        </div>
    </div>
}