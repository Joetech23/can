<?php
/**
 * Enquiry email body (also saved with each enquiry).
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

    $rows = array_filter([
        'Name' => $enquiry['name'] ?? null,
        'Email' => $enquiry['email'] ?? null,
        'Phone' => $enquiry['phone'] ?? null,
        'Organization' => $enquiry['organization'] ?? null,
        'Enquiry' => acpl('enquiry_types.'.$enquiry['enquiry_type']),
        'Routed to' => $unit,
    ]);
?>
<!DOCTYPE html>
<html lang="en">
    <body style="margin:0;padding:24px;background:#f5f1e8;font-family:Arial,Helvetica,sans-serif;color:#001233;">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border-radius:12px;overflow:hidden;">
            <tr>
                <td style="background:#001440;padding:24px 28px;color:#f2d18a;font-size:18px;">New website enquiry</td>
            </tr>
            <tr>
                <td style="padding:28px;">
                    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                        <?php foreach ( acpl_loop( $rows ) as [ $loop1, $label, $value ] ) : ?>
                            <tr>
                                <td style="padding:8px 0;width:140px;color:#56627a;font-size:13px;vertical-align:top;"><?php echo esc_html( $label ); ?></td>
                                <td style="padding:8px 0;font-size:14px;"><?php echo esc_html( $value ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>

                    <?php if ( '' !== ( $enquiry['message'] ?? '' ) ) : ?>
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Message</p>
                        <p style="margin:0;font-size:14px;line-height:1.6;white-space:pre-line;"><?php echo esc_html( $enquiry['message'] ); ?></p>
                    <?php endif; ?>

                    <?php if ( $answers !== [] ) : ?>
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Pre-consultation questionnaire</p>
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                            <?php foreach ( acpl_loop( $answers ) as [ $loop1, $question, $answer ] ) : ?>
                                <tr>
                                    <td style="padding:6px 0;width:220px;color:#56627a;font-size:13px;vertical-align:top;"><?php echo esc_html( $question ); ?></td>
                                    <td style="padding:6px 0;font-size:14px;"><?php echo esc_html( $answer ); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    <?php endif; ?>

                    <?php if ( $campaign !== [] ) : ?>
                        <p style="margin:24px 0 8px;color:#56627a;font-size:13px;">Where this lead came from</p>
                        <p style="margin:0;font-size:12px;line-height:1.6;color:#56627a;">
                            <?php foreach ( acpl_loop( $campaign ) as [ $loop1, $key, $value ] ) : ?>
                                <?php echo esc_html( $key ); ?>: <?php echo esc_html( $value ); ?><br>
                            <?php endforeach; ?>
                        </p>
                    <?php endif; ?>

                    <p style="margin:28px 0 0;font-size:12px;color:#56627a;">Reply to this email to respond directly to <?php echo esc_html( $enquiry['name'] ); ?>.</p>
                </td>
            </tr>
        </table>
    </body>
</html>
