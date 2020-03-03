<?php

namespace Modules\Icommerce\Events\Handlers;

use Modules\Icommerce\Entities\Order;
use Illuminate\Contracts\Mail\Mailer;
use Modules\Icommerce\Emails\OrderNotification;
use Modules\Notification\Services\Notification;

class UpdateOrderStatus
{

    /**
     * @var Mailer
     */
    private $mail;
    private $setting;
    private $notification;

    public function __construct(Mailer $mail, Notification $notification)
    {
        $this->mail = $mail;
        $this->setting = app('Modules\Setting\Contracts\Setting');
        $this->notification = $notification;
    }

    public function handle($event)
    {
        $data = $event->data;
        if (isset($data['order_id']) && isset($data['status'])){
            $order = Order::where('id', $data['order_id']);
            $order->update(['status_id' => $data['status']]);
        }
        if (isset($data) && $data['notify']) {
            $order = $order->first();
            $emails = explode(',', $this->setting->get('icommerce::form-emails'));
            $dataSend = ['form' => $emails, 'comment' => $data['comment']];
            $subject = "Notificación de Estado de la orden #" . $order->id;
            $view = "icommerce::emails.order-notifications";
            $this->notification->to($order->customer_id)->push('Notificaciòn Orden de compra', $subject, 'fas fa-store', 'account/orders/' . $order->id);

            $this->mail->to($order->email)->send(new \Modules\Icommerce\Emails\OrderNotification($order, $subject, $view, $dataSend));

        }
    }

}
