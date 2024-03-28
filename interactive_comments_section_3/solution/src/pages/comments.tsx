import SendForm from "../components/comments/UICommentElements/sendForm";
import CommentsList from "../components/comments/commentsList";

export function CommentsPage(){
    return <div className="p-16 max-w-[730px] mx-auto">
        <CommentsList></CommentsList>
        <SendForm>SEND</SendForm>
    </div>
}