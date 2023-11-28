<?php
/**
 * View template for Foody Booking Table widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */
?>
<?php
 $domain_ext=$settings['domain'];
    if($settings['domain'] == 'domain_other'){
        $domain_ext=$settings['domain_other'];
    }
    $rid = ent2ncr($settings['id_restaurant']);

if (!empty($settings['id_restaurant']) && intval($settings['id_restaurant'])) : ?>
            <div class="cafe-wrap cafe-booking-table">
                <form method="get" class="otw-widget-form" action="http://www.opentable.com/lago-east-bank-reservations-cleveland?restref=110065&datetime=2016-10-05T19%3A00&covers=2&searchdatetime=2016-10-05T19%3A00&partysize=2">
                    <div class="date-otreservations input-group input-group-lg">
                        <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                        <input id="date-otreservations" name="startDate" class="otw-reservation-date form-control input-lg" type="text" value="<?php echo date('d/m/Y');?>" autocomplete="off">
                    </div>
                
                    <div class="time-otreservations input-group input-group-lg">
                        <span class="input-group-addon"> <i class="fa fa-clock-o" aria-hidden="true"></i></span>
                        <select id="time-otreservations"  name="ResTime" class="selectpicker form-control input-lg">
                            <?php
                            //Time Loop
                            $inc   = 30 * 60;
                            $start = ( strtotime( '8AM' ) );
                            $end   = ( strtotime( '10:00PM' ) );
                            for ( $i = $start; $i <= $end; $i += $inc ) {
                                // to the standart format
                                $time      = date( 'g:i a', $i );
                                $timeValue = date( 'g:ia', $i );
                                $default   = "7:00pm";
                                echo "<option value=\"$timeValue\" " . ( ( $timeValue == $default ) ? ' selected="selected" ' : "" ) . ">$time</option>" . PHP_EOL;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="party-otreservations input-group input-group-lg">
                        <span class="input-group-addon"> <i class="fa fa-user" aria-hidden="true"></i></span>
                        <select id="party-otreservations" name="partySize" class="selectpicker form-control input-lg">
                            <option value="1"><?php echo esc_html__( '01 Person', 'cvca' ); ?></option>
                            <option value="2" selected="selected"><?php echo esc_html__( '2 People', 'cvca' ); ?></option>
                            <option value="3"><?php echo esc_html__( '03 People', 'cvca' ); ?></option>
                            <option value="4"><?php echo esc_html__( '04 People', 'cvca' ); ?></option>
                            <option value="5"><?php echo esc_html__( '05 People', 'cvca' ); ?></option>
                            <option value="6"><?php echo esc_html__( '06 People', 'cvca' ); ?></option>
                            <option value="7"><?php echo esc_html__( '07 People', 'cvca' ); ?></option>
                            <option value="8"><?php echo esc_html__( '08 People', 'cvca' ); ?></option>
                            <option value="9"><?php echo esc_html__( '09 People', 'cvca' ); ?></option>
                            <option value="10"><?php echo esc_html__( '10 People', 'cvca' ); ?></option>
                            <option value="11"><?php echo esc_html__( '11 People', 'cvca' ); ?></option>
                            <option value="12"><?php echo esc_html__( '12 People', 'cvca' ); ?></option>
                            <option value="13"><?php echo esc_html__( '13 People', 'cvca' ); ?></option>
                            <option value="14"><?php echo esc_html__( '14 People', 'cvca' ); ?></option>
                            <option value="15"><?php echo esc_html__( '15 People', 'cvca' ); ?></option>
                            <option value="16"><?php echo esc_html__( '16 People', 'cvca' ); ?></option>
                            <option value="17"><?php echo esc_html__( '17 People', 'cvca' ); ?></option>
                            <option value="18"><?php echo esc_html__( '18 People', 'cvca' ); ?></option>
                            <option value="19"><?php echo esc_html__( '19 People', 'cvca' ); ?></option>
                            <option value="20"><?php echo esc_html__( '20 People', 'cvca' ); ?></option>
                        </select>
                    </div>
                    <div class="btn-find-table input-group">
                        <input type="submit" class="btn btn-block btn-variant" value="<?php  echo esc_html__( 'Find a Table', 'cvca' ); ?>"/>
                    </div>
                    <input type="hidden" name="RestaurantID" class="RestaurantID" value="<?php echo $rid; ?>">
                    <input type="hidden" name="rid" class="rid" value="<?php echo $rid; ?>">
                    <input type="hidden" name="GeoID" class="GeoID" value="15">
                    <input type="hidden" name="txtDateFormat" class="txtDateFormat" value="<?php echo ! empty( $date_format ) ? $date_format : "dd/mm/yy"; ?>">
                    <input type="hidden" name="RestaurantReferralID" class="RestaurantReferralID" value="<?php echo $rid; ?>">
                </form>
            </div>
<?php else : ?>
    <span class="otreservations-error"><?php _e('You need to provide us with a valid numeric OpenTable restaurant ID.','cvca') ?></span>
<?php endif; ?>
