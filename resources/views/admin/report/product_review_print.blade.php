<div class="print_area">
    <div class="heading_area">
        <div class="row">
            <div class="col-md-8">
                <div class="company_name text-center">
                    <h3><b>My Shope </b></h3>
                    <h6>All Product Review</h6>
                </div>
            </div>
        </div>
    </div>
    <table class="w-100 table-bordered">
        <thead>
            <tr>
                <th>SL</th>
                <th>user</th>
                <th>Product Name</th>
                <th>review</th>
                <th>rating</th>
                <th>Predicted Emotion</th>
                <th>Review Date</th>
                <th>Review Month</th>
                <th>Review Year</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($review as $key => $row)
                <tr>
                    <td><h6 class="p-0 m-0">{{ ++$key }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->email }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->name }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->review }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->rating }}</h6></td>
                    <td>
                        <h6 class="p-0 m-0">
                            @if ($row->predicted_emotion == 0) 
                                Anger
                            @elseif ($row->predicted_emotion == 1) 
                                Boredom
                            @elseif ($row->predicted_emotion == 2) 
                                Empty
                            @elseif ($row->predicted_emotion == 3) 
                                Enthusiasm
                            @elseif ($row->predicted_emotion == 4) 
                                Fun
                            @elseif ($row->predicted_emotion == 5) 
                                Happiness
                            @elseif ($row->predicted_emotion == 6) 
                                Hate
                            @elseif ($row->predicted_emotion == 7) 
                                Love
                            @elseif ($row->predicted_emotion == 8) 
                                Neutral
                            @elseif ($row->predicted_emotion == 9) 
                                Relief
                            @elseif ($row->predicted_emotion == 10) 
                                Sadness
                            @elseif ($row->predicted_emotion == 11) 
                                Surprise
                            @elseif ($row->predicted_emotion == 12) 
                                Worry
                            @endif
                        </h6>
                    </td>
                    <td><h6 class="p-0 m-0">{{ $row->review_date }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->review_month }}</h6></td>
                    <td><h6 class="p-0 m-0">{{ $row->review_year }}</h6></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>