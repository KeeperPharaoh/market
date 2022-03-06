<?php


namespace App\Responses;


class ApiResponse
{
    public const SUCCESS = true;

    public const FAILURE = false;


    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function successMessage($data, $code): array
    {
        return [
            'message' => [
                'status'    => self::SUCCESS,
                'message'   => $data,
            ],
            'code'    => $code,
        ];
    }


    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function success($data, $code): array
    {
        return [
            'message' => [
                'status' => self::SUCCESS,
                'data'   => $data,
            ],
            'code'    => $code,
        ];
    }

    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function failureMessage($data, $code): array
    {
        return [
            'message' => [
                'status'    => self::FAILURE,
                'message'   => $data,
            ],
            'code'    => $code,
        ];
    }


    /**
     * @param $data
     * @param $code
     *
     * @return array
     */
    public static function failure($data, $code): array
    {
        return [
            'message' => [
                'status' => self::FAILURE,
                'data'   => $data,
            ],
            'code'    => $code,
        ];
    }
}
