<?php
/**
 * Component: site-footer.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;

extract( acpl_props( $args ?? array(), array() ) );
?>
<?php $company = acpl('company'); ?>

<footer class="relative overflow-hidden border-t border-white/10 bg-navy-900 text-white">
    <div class="pointer-events-none absolute -top-40 left-1/2 h-80 w-[60rem] -translate-x-1/2 rounded-full bg-gold-500/10 blur-3xl"></div>

    <div class="container-x relative">
        <div class="grid grid-cols-1 gap-14 border-b border-white/10 py-20 lg:grid-cols-12">
            <div class="lg:col-span-4">
                <?php acpl_c( 'logo', ['on-dark' => true] ); ?>
                <p class="mt-8 max-w-sm leading-relaxed text-white/60"><?php echo esc_html( $company['summary'] ); ?></p>
                <p class="mt-8 font-serif text-2xl text-gold-300 italic"><?php echo esc_html( $company['tagline'] ); ?></p>

                <div class="mt-8 flex gap-3">
                    <a href="https://wa.me/<?php echo esc_attr( $company['whatsapp'] ); ?>?text=<?php echo esc_html( rawurlencode($company['whatsapp_message']) ); ?>" target="_blank" rel="noopener" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Chat with us on WhatsApp"><?php acpl_c( 'icon', ['name' => 'whatsapp', 'class' => 'size-5'] ); ?></a>
                    <a href="mailto:<?php echo esc_attr( $company['email'] ); ?>" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Email us"><?php acpl_c( 'icon', ['name' => 'mail', 'class' => 'size-5'] ); ?></a>
                    <?php if ( $company['linkedin'] ) : ?>
                        <a href="<?php echo esc_url( $company['linkedin'] ); ?>" target="_blank" rel="noopener" class="grid size-11 place-items-center rounded-full border border-white/15 text-white/70 transition hover:border-gold-400 hover:text-gold-300" aria-label="Angelus Capital Partners on LinkedIn"><?php acpl_c( 'icon', ['name' => 'linkedin', 'class' => 'size-5'] ); ?></a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-10 sm:grid-cols-[1fr_1fr_1.6fr] lg:col-span-8">
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Company</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        <li><a href="<?php echo esc_url( acpl_url('about') ); ?>" class="text-white/65 transition hover:text-white">About ACPL</a></li>
                        <li><a href="<?php echo esc_url( acpl_url('leadership') ); ?>" class="text-white/65 transition hover:text-white">Leadership</a></li>
                        <li><a href="<?php echo esc_url( acpl_url('sectors') ); ?>" class="text-white/65 transition hover:text-white">Sectors & Transactions</a></li>
                        <li><a href="<?php echo esc_url( acpl_url('insights') ); ?>" class="text-white/65 transition hover:text-white">News & Insights</a></li>
                        <li><a href="<?php echo esc_url( acpl_url('contact') ); ?>" class="text-white/65 transition hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Platforms</h3>
                    <ul class="mt-6 space-y-3 text-sm">
                        <?php foreach ( acpl_loop( acpl('platforms') ) as [ $loop1, , $platform ] ) : ?>
                            <li>
                                <a href="<?php echo esc_url( acpl_url('services') ); ?>#<?php echo esc_html( $platform['key'] ); ?>" class="text-white/65 transition hover:text-white"><?php echo esc_html( $platform['title'] ); ?></a>
                                <?php if ( $platform['key'] === 'advisory' ) : ?>
                                    <a href="<?php echo esc_url( acpl_url('services') ); ?>#einvoice" class="mt-2 ml-3 block border-l border-gold-400/40 pl-3 text-xs text-white/50 transition hover:text-white">Compliance Advisory – E-Invoicing</a>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xs font-semibold tracking-[0.25em] text-gold-400 uppercase">Reach us</h3>
                    <ul class="mt-6 space-y-4 text-sm text-white/65">
                        <li class="flex gap-3">
                            <?php acpl_c( 'icon', ['name' => 'pin', 'class' => 'mt-0.5 size-4 text-gold-400'] ); ?>
                            <span><span class="block text-xs tracking-wider text-white/40 uppercase">Head office</span><?php echo implode('<br>', array_map('esc_html', $company['address'])); ?></span>
                        </li>
                        <?php if ( $company['annex_address'] ) : ?>
                            <li class="flex gap-3">
                                <?php acpl_c( 'icon', ['name' => 'pin', 'class' => 'mt-0.5 size-4 text-gold-400'] ); ?>
                                <span><span class="block text-xs tracking-wider text-white/40 uppercase"><?php echo esc_html( $company['annex_label'] ); ?></span><?php echo implode('<br>', array_map('esc_html', (array) $company['annex_address'])); ?></span>
                            </li>
                        <?php endif; ?>
                        <li><a href="tel:<?php echo esc_attr( $company['phone_href'] ); ?>" class="flex gap-3 transition hover:text-white"><?php acpl_c( 'icon', ['name' => 'phone', 'class' => 'mt-0.5 size-4 text-gold-400'] ); ?><?php echo esc_html( $company['phone'] ); ?></a></li>
                        <li><a href="mailto:<?php echo esc_attr( $company['email'] ); ?>" class="flex gap-3 break-words transition hover:text-white"><?php acpl_c( 'icon', ['name' => 'mail', 'class' => 'mt-0.5 size-4 text-gold-400'] ); ?><?php echo esc_html( $company['email'] ); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-4 py-8 text-xs text-white/45 lg:flex-row lg:items-center lg:justify-between">
            <p>
                &copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $company['name'] ); ?>.<?php if ( $company['rc_number'] ) : ?> <?php echo esc_html( $company['rc_number'] ); ?>.<?php endif; ?> All rights reserved.
            </p>
            <nav class="flex flex-wrap gap-x-6 gap-y-2" aria-label="Legal">
                <a href="<?php echo esc_url( acpl_url('privacy') ); ?>" class="transition hover:text-white">Privacy Policy</a>
                <a href="<?php echo esc_url( acpl_url('disclaimer') ); ?>" class="transition hover:text-white">Disclaimer</a>
                <span class="tracking-wide"><?php echo esc_html( $company['strapline'] ); ?></span>
            </nav>
        </div>
    </div>
</footer>
