<x-layout>
    <x-home.hero />
    
    <x-home.problem />
    
    <x-home.solution />
    
    <x-home.gallery :featuredGalleries="$featuredGalleries" />
    
    <x-home.testimonials />
    
    <x-home.calculator :vehicleCategories="$vehicleCategories" :calendar="$calendar" />
</x-layout>
