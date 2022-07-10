<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Collection;

enum SpecialCharacters: string
{
    use CasesValuesProviderTrait;

    case GRAVE_ACCENT           = '`';
    case APOSTROPHE             = '\'';
    case DOUBLE_QUOTATION_MARK  = '"';
    case OPEN_BRACKET           = '[';
    case CLOSE_BRACKET          = ']';
    case OPEN_BRACE             = '{';
    case CLOSE_BRACE            = '}';
    case OPEN_PARENTHESIS       = '(';
    case CLOSE_PARENTHESIS      = ')';
    case BACK_SLASH             = '\\';
    case PIPE                   = '|';
    case FORWARD_SLASH          = '/';
    case ASTERISK               = '*';
    case PERCENT                = '%';
    case CARET                  = '^';
    case LESS_THAN              = '<';
    case GREATER_THAN           = '>';
    case COMMA                  = ',';
    case DOT                    = '.';
    case COLON                  = ':';
    case SEMICOLON              = ';';
    case PLUS                   = '+';
    case MINUS                  = '-';
    case EQUAL                  = '=';
    case TILDE                  = '~';
    case EXCLAMATION_POINT      = '!';
    case AMPERSAT               = '@';
    case OCTOTHORPE             = '#';
    case NUMBER                 = '№';
    case DOLLAR                 = '$';
    case AMPERSAND              = '&';
    case QUESTION_MARK          = '?';
    case UNDERSCORE             = '_';
}
