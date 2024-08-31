<?php

namespace App\Enum;

enum PlanType: string
{

    case YEARLY = 'yearly';
    case HALFYEARLY =  'half_yearly';
    case QUATERLY =  'quaterly';
    case TWOMONTHS =  'two_months';
    case MONTHLY =  'monthly';
}
