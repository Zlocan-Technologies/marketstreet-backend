<div class="email-right-aside">
    <div class="card email-body">
        <div class="email-profile">                                  
        <div class="email-body">                                        
            <div class="email-compose">
            <div class="email-top compose-border">                                              
                <div class="compose-header py-2 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Send Notification/Email to Users</h4>
                    <button onclick="pushNotification(event)" id="push-notif-btn" class="btn btn-primary" type="button"><i class="fa fa-send me-2"></i> send</button>
                </div>
            </div>
            <div class="email-wrapper">
                <form class="theme-form">
                    <div class="form-group d-flex justify-content-start align-items-center">
                        <div class="px-2">
                            <input type="radio" name="message_type" value="email" id="email_type">
                            <label for="email">Send as Email</label>
                        </div>

                        <div class="px-2">
                            <input type="radio" name="message_type" value="notification" id="notification">
                            <label for="notification">Send as Notification</label>
                        </div>
                    </div>
                    <div class="row email-tab d-none" id="email-tab">
                        <div class="form-group col-lg-6 d-none" id="toMailTab">
                            <label for="toMail">To</label>
                            <input disabled class="form-control" name id="toMail" required type="text">
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="subject">Subject</label>
                            <input class="form-control" name id="subject" required type="text">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea id="editor1" name="editor1" cols="8" rows="2"></textarea>
                    </div>
                </form>
                
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>


<style>
    .theme-form .form-group {
        margin-bottom: 5px !important;
    }
</style>
