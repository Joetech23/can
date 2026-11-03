<?php
/**
 * Template: page-contact.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', ['title' => 'Contact', 'description' => 'Contact Angelus Capital Partners Limited — 173 Ogudu Road, Ogudu, Lagos, Nigeria.'] ); ?>
    <?php
    $company = acpl('company');
    // phpcs:disable WordPress.Security.NonceVerification.Recommended -- read-only prefill from links.
    $requestedType = isset( $_GET['enquiry'] ) ? sanitize_key( wp_unslash( $_GET['enquiry'] ) ) : '';
    $selectedEnquiryType = array_key_exists( $requestedType, acpl('enquiry_types') ) ? $requestedType : 'advisory';
    // Questionnaire answers arrive from the landing page (?q[challenge]=...), or come back after a validation error.
    $answers = acpl_valid_answers( acpl_old( 'answers', isset( $_GET['q'] ) ? wp_unslash( $_GET['q'] ) : array() ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- validated against the option list.
    // phpcs:enable
    ?>

    <?php acpl_c( 'page-hero', ['index' => '06', 'eyebrow' => 'Contact us', 'title' => 'Let’s start a <span class=\'text-gold-gradient\'>conversation.</span>', 'lead' => 'We look forward to partnering with organizations seeking sustainable growth and transformational outcomes.'] ); ?>

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-12 lg:grid-cols-12">
            <?php /* Details */ ?>
            <aside class="flex flex-col gap-5 lg:col-span-5">
                <?php foreach ( acpl_loop( array_filter([
                    ['icon' => 'pin', 'label' => 'Head office', 'value' => implode(', ', $company['address']), 'href' => 'https://www.google.com/maps/search/?api=1&query='.urlencode($company['map_query']), 'external' => true],
                    $company['annex_address'] ? ['icon' => 'pin', 'label' => $company['annex_label'], 'value' => implode(', ', (array) $company['annex_address']), 'href' => 'https://www.google.com/maps/search/?api=1&query='.urlencode(implode(', ', (array) $company['annex_address'])), 'external' => true] : null,
                    ['icon' => 'phone', 'label' => 'Call', 'value' => $company['phone'], 'href' => 'tel:'.$company['phone_href'], 'external' => false],
                    ['icon' => 'whatsapp', 'label' => 'WhatsApp', 'value' => 'Chat with us on WhatsApp', 'href' => 'https://wa.me/'.$company['whatsapp'].'?text='.rawurlencode($company['whatsapp_message']), 'external' => true],
                    ['icon' => 'mail', 'label' => 'Email', 'value' => $company['email'], 'href' => 'mailto:'.$company['email'], 'external' => false],
                    $company['linkedin'] ? ['icon' => 'linkedin', 'label' => 'LinkedIn', 'value' => 'Follow Angelus Capital Partners', 'href' => $company['linkedin'], 'external' => true] : null,
                ]) ) as [ $loop1, , $detail ] ) : ?>
                    <a href="<?php echo esc_url( $detail['href'] ); ?>" <?php if ( $detail['external'] ) : ?> target="_blank" rel="noopener" <?php endif; ?> class="card-light group flex items-center gap-5 p-6 transition duration-500 hover:-translate-y-1" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 90 ); ?>ms">
                        <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">
                            <?php acpl_c( 'icon', ['name' => $detail['icon'], 'class' => 'size-6'] ); ?>
                        </span>
                        <span class="min-w-0">
                            <span class="block text-xs font-semibold tracking-[0.2em] text-gold-600 uppercase"><?php echo esc_html( $detail['label'] ); ?></span>
                            <span class="mt-1 block font-medium break-words text-navy-900"><?php echo esc_html( $detail['value'] ); ?></span>
                        </span>
                        <?php acpl_c( 'icon', ['name' => 'arrow-up-right', 'class' => 'ml-auto size-5 shrink-0 text-navy-900/30 transition group-hover:text-gold-600'] ); ?>
                    </a>
                <?php endforeach; ?>

                <a href="<?php echo esc_url( acpl_url('contact', ['enquiry' => 'einvoice']) ); ?>#enquire" class="on-dark relative isolate block overflow-hidden rounded-3xl bg-navy-900 p-7 text-white transition duration-500 hover:-translate-y-1" data-reveal>
                    <div class="absolute -top-16 -right-16 -z-10 size-48 rounded-full bg-gold-500/25 blur-3xl"></div>
                    <span class="inline-flex items-center gap-2 rounded-full bg-gold-400/15 px-3 py-1 text-xs font-semibold tracking-wider text-gold-300 uppercase"><?php acpl_c( 'icon', ['name' => 'document', 'class' => 'size-4'] ); ?> Advisory · Compliance</span>
                    <p class="mt-4 font-display text-2xl"><?php echo esc_html( acpl('einvoice.title') ); ?></p>
                    <p class="mt-2 text-sm leading-relaxed text-white/65"><?php echo esc_html( acpl('einvoice.summary') ); ?></p>
                    <span class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-gold-300">Ask about e-invoice compliance <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></span>
                </a>

                <div class="overflow-hidden rounded-3xl border border-navy-900/8 bg-white" data-reveal>
                    <iframe title="Map showing <?php echo esc_html( $company['map_query'] ); ?>" src="https://www.google.com/maps?q=<?php echo esc_html( urlencode($company['map_query']) ); ?>&output=embed" class="h-72 w-full grayscale-[0.4]" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </aside>

            <?php /* Form */ ?>
            <div id="enquire" class="scroll-mt-24 lg:col-span-7">
                <div class="card-light p-8 sm:p-12" data-reveal="right">
                    <h2 class="font-display text-3xl text-navy-900 sm:text-4xl">Send us an enquiry</h2>
                    <p class="mt-3 text-mist">Choose a topic and your enquiry goes straight to the team that handles it. Fields marked * are required.</p>

                    <form method="POST" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="mt-10 grid grid-cols-1 gap-6 sm:grid-cols-2" novalidate>
                        <input type="hidden" name="action" value="acpl_enquiry">
                        <?php if ( acpl_has_errors() ) : ?>
                            <p class="rounded-2xl bg-red-50 px-5 py-4 text-sm font-medium text-red-700 sm:col-span-2" role="alert">Please check the highlighted fields and try again.</p>
                        <?php endif; ?>

                        <?php if ( $answers !== [] ) : ?>
                            <?php /* Pre-consultation questionnaire answers from the landing page */ ?>
                            <div class="rounded-2xl border border-gold-500/30 bg-sand/60 p-5 sm:col-span-2">
                                <p class="text-xs font-semibold tracking-[0.2em] text-gold-700 uppercase">Your answers</p>
                                <dl class="mt-3 grid grid-cols-1 gap-x-6 gap-y-2 text-sm sm:grid-cols-2">
                                    <?php foreach ( acpl_loop( $answers ) as [ $loop1, $key, $answer ] ) : ?>
                                        <div>
                                            <dt class="text-mist"><?php echo esc_html( acpl("questionnaire.{$key}.label") ); ?></dt>
                                            <dd class="font-medium text-navy-900"><?php echo esc_html( $answer ); ?></dd>
                                        </div>
                                        <input type="hidden" name="answers[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $answer ); ?>">
                                    <?php endforeach; ?>
                                </dl>
                            </div>
                        <?php endif; ?>

                        <div class="hidden" aria-hidden="true">
                            <label for="company_website">Leave this field empty</label>
                            <input type="text" id="company_website" name="company_website" tabindex="-1" autocomplete="off">
                        </div>

                        <?php foreach ( acpl_loop( [
                            ['name' => 'name', 'label' => 'Full name *', 'type' => 'text', 'autocomplete' => 'name'],
                            ['name' => 'email', 'label' => 'Email address *', 'type' => 'email', 'autocomplete' => 'email'],
                            ['name' => 'phone', 'label' => 'Phone number', 'type' => 'tel', 'autocomplete' => 'tel'],
                            ['name' => 'organization', 'label' => 'Organization', 'type' => 'text', 'autocomplete' => 'organization'],
                        ] ) as [ $loop1, , $field ] ) : ?>
                            <div>
                                <label for="<?php echo esc_attr( $field['name'] ); ?>" class="mb-2 block text-sm font-semibold text-navy-900"><?php echo esc_html( $field['label'] ); ?></label>
                                <input type="<?php echo esc_attr( $field['type'] ); ?>" id="<?php echo esc_attr( $field['name'] ); ?>" name="<?php echo esc_attr( $field['name'] ); ?>" value="<?php echo esc_attr( acpl_old($field['name']) ); ?>" autocomplete="<?php echo esc_attr( $field['autocomplete'] ); ?>" class="<?php echo esc_attr( acpl_class( ['field', '!border-red-400' => acpl_has_error($field['name'])] ) ); ?>" <?php if ( acpl_has_error( $field['name'] ) ) : $message = acpl_error( $field['name'] ); ?> aria-invalid="true" aria-describedby="<?php echo esc_attr( $field['name'] ); ?>-error" <?php endif; ?>>
                                <?php if ( acpl_has_error( $field['name'] ) ) : $message = acpl_error( $field['name'] ); ?>
                                    <p id="<?php echo esc_attr( $field['name'] ); ?>-error" class="mt-2 text-sm text-red-600"><?php echo esc_html( $message ); ?></p>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                        <fieldset class="sm:col-span-2">
                            <legend class="mb-3 block text-sm font-semibold text-navy-900">How can we help? *</legend>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ( acpl_loop( acpl('enquiry_types') ) as [ $loop1, $value, $label ] ) : ?>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="enquiry_type" value="<?php echo esc_attr( $value ); ?>" class="peer sr-only" <?php echo ( acpl_old('enquiry_type', $selectedEnquiryType) === $value ) ? 'checked' : ''; ?>>
                                        <span class="block rounded-full border border-navy-900/15 px-4 py-2.5 text-sm text-navy-800 transition peer-checked:border-navy-900 peer-checked:bg-navy-900 peer-checked:text-white peer-focus-visible:ring-4 peer-focus-visible:ring-gold-400/40 hover:border-navy-900/40"><?php echo esc_html( $label ); ?></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                            <?php if ( acpl_has_error( 'enquiry_type' ) ) : $message = acpl_error( 'enquiry_type' ); ?>
                                <p class="mt-2 text-sm text-red-600"><?php echo esc_html( $message ); ?></p>
                            <?php endif; ?>
                        </fieldset>

                        <div class="sm:col-span-2">
                            <label for="message" class="mb-2 block text-sm font-semibold text-navy-900">Message <span class="font-normal text-mist">(optional)</span></label>
                            <textarea id="message" name="message" rows="6" class="<?php echo esc_attr( acpl_class( ['field resize-y', '!border-red-400' => acpl_has_error('message')] ) ); ?>" <?php if ( acpl_has_error( 'message' ) ) : $message = acpl_error( 'message' ); ?> aria-invalid="true" aria-describedby="message-error" <?php endif; ?>><?php echo esc_textarea( acpl_old('message') ); ?></textarea>
                            <?php if ( acpl_has_error( 'message' ) ) : $message = acpl_error( 'message' ); ?>
                                <p id="message-error" class="mt-2 text-sm text-red-600"><?php echo esc_html( $message ); ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="flex flex-col gap-4 sm:col-span-2 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs text-mist">We treat every enquiry in confidence.</p>
                            <button type="submit" class="btn-gold">Send enquiry <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
<?php acpl_end( 'layouts.app' ); ?>
