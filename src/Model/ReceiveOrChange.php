<?php

namespace BrianHenryIE\BtcRpcExplorer\Model;

enum ReceiveOrChange: int
{
    case RECEIVE = 0;
    case CHANGE = 1;
}
