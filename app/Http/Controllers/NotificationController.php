<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;
use App\Models\Feedback;
use App\Models\Customer;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentReminder;  
use App\Services\UltraMsgService;

class NotificationController extends Controller
{

    protected $ultraMsgService;
    /**
     * Display the notifications management page
     */
    public function __construct(UltraMsgService $ultraMsgService)
    {
        $this->ultraMsgService = $ultraMsgService;
    }

    public function view()
    {
        $upcomingAppointments = Appointment::with('customer', 'services')
            ->where('status', 'confirmed')
            ->whereDate('date', '>', now())
            ->orderBy('date')
            ->orderBy('time')
            ->get();

        $promotions = Promotion::where('validUntil', '>=', now())->get();

        $usedToBeCustomers = Customer::withCount(['appointments' => function($query) {
            $query->where('date', '<', now()->format('Y-m-d'))
                ->where('status', 'completed');
        }])->having('appointments_count', '>', 0)
        ->get();

        return view('admin.notification', [
            'appointments' => $upcomingAppointments,
            'promotions' => $promotions,
            'usedToBeCustomers'=>$usedToBeCustomers
        ]);
    }
    //this is the goat that will be sent message to the Whatapps (or for testing)
    public function sendNotification(string $message){
        $to = '60108030465'; // Include country code (e.g., 14155552671)
        $response = $this->ultraMsgService->sendMessage($to, $message);
    }

    public function appointmentNotification(Request $request )
    {
        // Get all input data
        $customerName = $request->input('customerName');
        $appointmentDate = $request->input('appointmentDate');
        $appointmentTime = $request->input('appointmentTime');


        $message = $this->appointmentReminderTemplate([
            'customer_name' => $customerName,
            'appointment_date' => $appointmentDate,
            'appointment_time' => $appointmentTime
        ]);
        $this->sendNotification($message);
        return back()->with('message', $message);
    }

    public function promotionNotification(Request $request)
    {
        $promoTitle = $request->input('promoTitle');
        $promoDescription = $request->input('promoDescription');
        $promoValidDate = $request->input('promoValidDate');

        $message = $this->promotionBroadcastTemplate([
            'promo_title' => $promoTitle,
            'valid_until_date' => $promoDescription,
            'promo_description' => $promoValidDate
        ]);

        $this->sendNotification($message);
        return back()->with('message', $message);

    }

    public function feedbackNotification(Request $request){
        $customerName = $request->input('customerName');

        $message = $this->feedbackRequestTemplate([
            'customer_name' => $customerName,
        ]);

        $this->sendNotification($message);
        return back()->with('message', $message);
    }

    public static function appointmentReminderTemplate(array $data): string
    {
        return sprintf(
            "Hi %s! 👋\n\n" .
            "We're from *Sarlini Salon* wishing you a wonderful day! ✨\n\n" .
            "This is a friendly reminder about your appointment:\n\n" .
            "📅 *Date:* %s\n" .
            "⏰ *Time:* %s\n\n" .
            "📍 *Location:* Sarlini Salon, 2014, Lorong Telekom, Bandar Tawau,
                            91000 Tawau, Sabah
                            Malaysia\n" .
            "📞 *Contact:* +60 132918836\n\n" .
            "💡 *Please note:* - Please arrive 10 minutes before your appointment time\n\n" .
            "Just a quick heads-up, sometimes our stylists might need to take emergency leave. If that happens, your appointment will either be handled by another available stylist or you can choose to book another day/time. Thanks so much for understanding! 💇‍♀️💖\n\n" .
            "We're looking forward to seeing you and making your experience magical! 💫\n\n" .
            "Warm regards,\n" .
            "The Sarlini Salon Team",
            $data['customer_name'],
            $data['appointment_date'],
            $data['appointment_time'],
        );
    }
    public static function promotionBroadcastTemplate(array $data): string
    {
        return sprintf(
            "🌟 *EXCLUSIVE PROMO ALERT!* 🌟\n\n" .
            "Dear Customers! 👋\n\n" .
            "Here's a special treat from *Sarlini Salon* just for you!\n\n" .
            "🔥 *PROMO:* %s\n" .
            "⏳ *Valid until:* %s\n\n" .
            "💖 *What you get:*\n%s\n\n" .
            "📍 *Where:* Sarlini Salon, 2014, Lorong Telekom, Bandar Tawau,
                            91000 Tawau, Sabah
                            Malaysia\n" .
            "📞 *Book Now:* +60 132918836\n\n" .
            "Don't miss out on this amazing offer! " .
            "Warm regards,\n" .
            "The Sarlini Salon Team 💅✨",
            $data['promo_title'],
            $data['valid_until_date'],
            $data['promo_description'],
        );
    }
    public static function feedbackRequestTemplate(array $data): string
    {
        return sprintf(
            "Hi %s! 👋\n\n" .
            "Thank you for choosing *Sarlini Salon*!\n\n" .
            "We'd love your feedback ❤️. You also can provide through the website on Appointment Schedule :).\n" .
            "How was your recent visit?\n\n" .
            "Reply with:\n" .
            "1️⃣ - Excellent\n" .
            "2️⃣ - Good\n" .
            "3️⃣ - Needs improvement\n\n" .
            "Your opinion helps us serve you better!\n\n" .
            "Warm regards,\n" .
            "Sarlini Salon Team",
            $data['customer_name']
        );
    }
}
