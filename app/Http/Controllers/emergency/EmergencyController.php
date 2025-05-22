<?php

namespace App\Http\Controllers\emergency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmergenciesType;
use App\Models\Emergency;

class EmergencyController extends Controller
{
    // public $channelToken = 'L4x3vp1t8f4gDx+op2v5bYQO3lozP3T+2aMMhEjtl9CkmsMiAJ8fNC+BqRReVSTEiZk6gR5oRs73p2QyZzNlyuB2ziCpX/zcNGLK1xGRAmDKMj/NXq3x9IRdLYZjLQZs1z3llUhNnlpNMB8iqvP7NwdB04t89/1O/w1cDnyilFU=';
    // public $group_id = 'C39a38abf0c6ddb8679a7524748fd0f37';
    public $channelToken = 'rXAqVM4Sst0WA8i3aSmEAhKcwqdY4o4zO+dOkzAY3E/h7Ykx1FOUaXdE2avc1a4IvsOW9EntkqXExh0DN4BHBzMv5gLBRXjdyIiVMh3wP4Ff5yMIRMM+t7zDE2Umab5h2ka39GPidW3dzYxqS2Q0NgdB04t89/1O/w1cDnyilFU=';
    public $group_id = 'Ca15d5804ebf27251b427533420e27e6f';

    public function index()
    {
        return view('emergency.app');
    }

    public function send(Request $request)
    {
        dd($request);
        $input = $request->input();

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($file->isValid()) {
                $path = $file->store('/uploads/emergency', 'public');

                $insert = new Emergency();
                $insert->detail = $input['detail'];
                $insert->photo = $path;
                $insert->type = $input['options'];
                $insert->tel = $input['tel'];
                $insert->lat = $input['latitude'];
                $insert->long = $input['longitude'];
                $insert->created_at = date('Y-m-d H:i:s');
                $insert->updated_at = date('Y-m-d H:i:s');
                if ($insert->save()) {
                    $type = EmergenciesType::where('id', $input['options'])->first();
                    $text = "แจ้งเหตุ มี" . $type->name . "\n" . 'เบอร์ติดต่อ ' . $input['tel'] . "\n" . $input['detail'] . "\nhttps://www.google.com/maps?q=" . $input['latitude'] . ',' . $input['longitude'];
                    $data = [
                        'text' => $text,
                        'photo' => 'https://khlong.udom.eservice.sosmartsolution.com/storage/' . $path
                    ];
                    $this->sendGps($data);
                    return response()->json([
                        'status' => true,
                        'message' => 'แจ้งเหตุไปยังหน่วยงานที่เกี่ยวเรียบร้อยแล้ว'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'ไฟล์ไม่สมบูรณ์'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'ไม่พบไฟล์ที่อัปโหลด'
            ]);
        }
    }

    public function sendGps($data)
    {
        $messageData = [
            'to' => $this->group_id,
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $data['text']
                ],
                [
                    'type' => 'image',
                    'originalContentUrl' => $data['photo'],
                    'previewImageUrl' => $data['photo']
                ]
            ]
        ];

        $ch = curl_init('https://api.line.me/v2/bot/message/push');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->channelToken
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($messageData));

        $result = curl_exec($ch);
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpStatus == 200) {
            return true;
        } else {
            return false;
        }
    }
}
