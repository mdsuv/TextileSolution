@extends('admin_layout')
@section('admin_content')
    <?php $gtotal = 0;?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <a class="btn btn-success" href="{{route('styles.index',['oid'=>$order->id])}}">Styles</a>
                <a class="btn btn-success" href="{{route('accessories.index',['oid'=>$order->id])}}">Accessories</a>
                </br>
                <h2>Order Details</h2>
                <table class="table table-bordered">
                    <thead>
                    <th>Sl.</th>
                    <th>Style No.</th>
                    <th>Art No.</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Var</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    @foreach($sizes as $size)
                        <th>{{$size->name}}</th>
                    @endforeach
                    </thead>
                    @foreach($order->styles as $style)
                        <tbody>
                        <td rowspan="{{$style->size_color->count()}}">{{$loop->index+1}}</td>
                        <td rowspan="{{$style->size_color->count()}}">{{$style->style_no}}</td>
                        <td rowspan="{{$style->size_color->count()}}">{{$style->art_no}}</td>
                        <td rowspan="{{$style->size_color->count()}}">{{$style->description}}</td>
                        <td rowspan="{{$style->size_color->count()}}">{{$style->qty}} PCS</td>
                        <?php
                        $size_color_usable = [];
                        foreach ($style->size_color as $size_color) {
                            if (array_key_exists($size_color->color_id, $size_color_usable)) {
                                $size_color_usable[$size_color->color_id]['total_qty'] = $size_color_usable[$size_color->color_id]['total_qty'] + $size_color->qty;
                                array_push($size_color_usable[$size_color->color_id]['items'], ['size_id' => $size_color->size_id, 'quantity' => $size_color->qty]);
                            } else {
                                $size_color_usable[$size_color->color_id]['total_qty'] = $size_color->qty;
                                $size_color_usable[$size_color->color_id]['items'] = [['size_id' => $size_color->size_id, 'quantity' => $size_color->qty]];
                            }
                        }

                        foreach ($size_color_usable as $key => $value) {
                            echo '<tr><td>' . \App\Color::find($key)->var . '</td>';
                            echo '<td>' . \App\Color::find($key)->name . '</td>';
                            echo '<td>' . $size_color_usable[$key]['total_qty'] . '</td>';
                            $gtotal += $size_color_usable[$key]['total_qty'];
                            foreach (\App\Size::all() as $size) {
                                echo '<td>';
                                foreach ($size_color_usable[$key]['items'] as $item) {
                                    if ($item['size_id'] == $size->id) {
                                        echo $item['quantity'];
                                    }
                                }
                                echo '</td>';
                            }
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>


@endsection()