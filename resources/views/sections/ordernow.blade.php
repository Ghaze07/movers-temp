<!-- Order Now -->
<section id="ordernow">
    <services :flights_prop="{{ json_encode($flights)}}" :parkings_prop="{{ json_encode($parkings)}}" :authenticated="{{ $authenticated }}"></services>
</section>