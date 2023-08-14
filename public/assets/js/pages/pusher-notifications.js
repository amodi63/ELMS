var parentCount = $(".bgi-size-cover");
var notificationsSpan = parentCount.find("span[data-count]");
var notificationsCount = notificationsSpan.data("count");
var notifications = $(".drop-down-notfiy").find("div.navi-hover");
// Subscribe to the channel we specified in our Laravel Event
var channel = pusher.subscribe(`App.Models.User.${userID}`);
// Bind a function to a Event (the full Laravel class)
channel.bind("App\\Events\\OrderCreated", function (data) {
    var existingNotifications = notifications.html();
    var newNotificationHtml = `<a href="${data.url}?notification_id='${data.id}'">
                            <div class="navi-link">
                                <div class="navi-icon mr-2">
                                    <i class="${data.icon}"></i>
                                </div>
                                <div class="navi-text">
                                    <div class="font-weight-bolder ">${data.body}</div>
                                    <div class="text-muted">${data.time}</div>
                                </div>
                            </div>
                        </a>`;
    notifications.html(newNotificationHtml + existingNotifications);
    notificationsCount += 1;
    notificationsSpan.attr('data-count', notificationsCount)
    notificationsSpan.text(notificationsCount);
});
