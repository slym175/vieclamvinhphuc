<div class="chat-panel" hidden>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <a href="javascript:void(0);"><i class="ik ik-message-square text-success"></i></a>
            <span class="user-name">John Doe</span>
            <button type="button" class="close" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="card-body">
            <div class="widget-chat-activity flex-1">
                <div class="messages">

                    <div class="message media reply">
                        <figure class="user--online">
                            <a href="#">
                                <img src="{{ asset('assets/admin/images/users/3.jpg') }}" class="rounded-circle" alt="">
                            </a>
                        </figure>
                        <div class="message-body media-body">
                            <p>Epic Cheeseburgers come in all kind of styles.</p>
                        </div>
                    </div>
                    <div class="message media">
                        <figure class="user--online">
                            <a href="#">
                                <img src="{{ asset('assets/admin/images/users/1.jpg') }}" class="rounded-circle" alt="">
                            </a>
                        </figure>
                        <div class="message-body media-body">
                            <p>Cheeseburgers make your knees weak.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <form action="javascript:void(0)" class="card-footer" method="post">
            <div class="d-flex justify-content-end">
                <textarea class="border-0 flex-1" rows="1" placeholder="Type your message here"></textarea>
                <button class="btn btn-icon" type="submit"><i class="ik ik-arrow-right text-success"></i></button>
            </div>
        </form>
    </div>
</div>
