<table>
      <tr>
        <th>No</th>
        <th>Open</th>
        <th>Durasi</th>
        <th>User</th>
        <th>Type</th>
        <th>Locker</th>
        <th>Eksekutor</th>
        <th>MYIR</th>
        <th>Email</th>
        <th>ODP</th>
        <th>PORT</th>
        <th>Message</th>
        <th>Status</th>
      </tr>
     @foreach ($order as $index => $item)
        <tr>
          <td>{{$index+1}}</td>
          <td>{{($item->open_date)}}</td>
          <td>
            @if (isset($item->durasi))
              {{$item->durasi}}
            @else
              -
            @endif
          </td>
          <td>
            {{$m_user->getUserFromId($item->id_requester)['user_telegram']}}
          </td>
          <td>
            {{$m_type_order->getTypeOrder($item->id_type_order)}}
          </td>
          <td>
              @if (isset($item->id_requester))
                {{$m_locker->getLockerFromId($m_user->getUserFromId($item->id_requester)['id_locker'])}}
                @else
                -
              @endif
          </td>
          <td>
          
            @if (isset($item->id_eksekutor))
              {{$m_user->getUserFromId($item->id_eksekutor)['user_telegram']}}    
            @else
              -
            @endif
          </td> 
          <td>
            @if (isset($item->myir))
              <div id="myir_{{$item->id_order}}">{{$item->myir}}</div>
            @else 
              <div id="myir_{{$item->id_order}}">-</div>
            @endif
            
          </td>
          <td>
              @if (isset($item->email))
              {{$item->email}}    
            @else 
              -  
            @endif
          </td>
          <td>
            @if (isset($item->odp))
              {{$item->odp}}    
            @else 
              -  
            @endif
          </td>
          <td>
            @if (isset($item->port))
              {{$item->port}}    
            @else 
              -  
            @endif
          </td>
          <td id="td_{{$item->id_order}}" data-toggle="modal" data-target="#modal-message" class="message">
          
            @if (isset($item->message))
              <?php echo $item->message; ?>   
            @else 
              -  
            @endif
          </td>
          <td>{{$m_status_order->getStatusOrderFromId($item->id_status_order)}}</td>
        </tr>
        @endforeach
</table>