<?

namespace App\StatusCode;

use Illuminate\Http\Response;

class DeleteCode implements StatusCode
{
    public static function get($success)
    {
        return $success ? Response::HTTP_NO_CONTENT : Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}