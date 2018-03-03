<?

namespace App\StatusCode;

use Illuminate\Http\Response;

class CreateCode implements StatusCode
{
    public static function get($success)
    {
        return $success ? Response::HTTP_CREATED : Response::HTTP_UNPROCESSABLE_ENTITY;
    }
}