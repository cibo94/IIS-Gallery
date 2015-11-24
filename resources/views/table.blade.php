 <table class="table table-striped">
     <thead>
     <tr>
         @foreach($header as $head)
             <th>{!! $head !!}</th>
         @endforeach
     </tr>
     </thead>
     <tbody>
     @foreach($table as $row)
         <tr>
             @foreach($row as $item)
                 <td>{!! $item !!}</td>
             @endforeach
         </tr>
     @endforeach
     </tbody>
 </table>
