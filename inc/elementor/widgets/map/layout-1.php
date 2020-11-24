<?php
$id = uniqid( 'google-map-' );
$zoom = $settings['zoom'];
$scroll = empty( $settings['prevent_scroll'] ) ? 'false' : 'true';
$key = $settings['api'];
$marker =$settings['marker'];
$locations[] = array(
	'lat'   =>  $settings['lat'],
	'lng'   =>  $settings['lng']
);
$thumbnail = $settings['image'] ;
if ( ! empty( $thumbnail['id'] ) )
{
	$image_src = get_image_custom_size_url( $thumbnail['id'], 170, 130 );
	$map_info[] = sprintf( '<div class="thumbnail"><img src="%s" /></div>', $image_src );
}
$map_info[] = sprintf( '<div class="address">%s</div>', esc_html( $settings['detail'] ) );
$content = '';
if ( count( $map_info ) > 0 )
{
	$content = sprintf( '<div class="map-content align-items-center d-flex">%s</div>', implode( '', $map_info ) );
}
?>
<div class="butler-google-map-container">
	<div id="<?php echo esc_attr( $id ); ?>" class="butler-map"></div>
</div>
<script>
	function initMap()
	{
		var mapDiv = document.getElementById('<?php echo esc_attr($id); ?>');
		var firstLocationLat = <?php echo esc_attr($locations[0]['lat']); ?>;
		var firstLocationLong = <?php echo esc_attr($locations[0]['lng']); ?>;

		window.map = new google.maps.Map(mapDiv, {
			center: {lat: firstLocationLat, lng:  firstLocationLong},
			zoom: <?php echo $zoom['size']; ?>,
			scrollwheel: <?php echo $scroll; ?>
		});

		var iconUrl = '<?php echo esc_url( $marker['url'] ); ?>';
		var locations = <?php echo json_encode( $locations ); ?>;
		var marker = new google.maps.Marker({
			position: new google.maps.LatLng( firstLocationLat, firstLocationLong ),
			icon: iconUrl,
			map: window.map
		});

		var infoWindow = new google.maps.InfoWindow({
			content: '<?php echo $content; ?>',
			maxWidth: 400
		});
		google.maps.event.addListener(marker, 'click', function () {
			infoWindow.open(window.map, marker);
		});
	}
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?sensor=false&key=<?php echo esc_attr( $key ); ?>&callback=initMap">
</script>