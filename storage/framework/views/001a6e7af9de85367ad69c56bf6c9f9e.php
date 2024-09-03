<?php
    use Filament\Support\Facades\FilamentView;

    $hasInlineLabel = $hasInlineLabel();
    $id = $getId();
    $isConcealed = $isConcealed();
    $isDisabled = $isDisabled();
    $isPrefixInline = $isPrefixInline();
    $isSuffixInline = $isSuffixInline();
    $prefixActions = $getPrefixActions();
    $prefixIcon = $getPrefixIcon();
    $prefixLabel = $getPrefixLabel();
    $suffixActions = $getSuffixActions();
    $suffixIcon = $getSuffixIcon();
    $suffixLabel = $getSuffixLabel();
    $statePath = $getStatePath();

    $isLive = $isLive();
    $isLiveOnBlur = $isLiveOnBlur();
    $isLiveDebounced = $isLiveDebounced();
    $liveDebounce = $getLiveDebounce();

    $cssUrl = \Filament\Support\Facades\FilamentAsset::getStyleHref('filament-phone-input', package: 'ysfkaya/filament-phone-input');

    $compiledCssUrl = Js::from($cssUrl);
?>

<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\DynamicComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field,'has-inline-label' => $hasInlineLabel]); ?>
     <?php $__env->slot('label', null, ['class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(\Illuminate\Support\Arr::toCssClasses([
            'sm:pt-1.5' => $hasInlineLabel,
        ]))]); ?> 
        <?php echo e($getLabel()); ?>

     <?php $__env->endSlot(); ?>

    <?php if (isset($component)) { $__componentOriginal505efd9768415fdb4543e8c564dad437 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal505efd9768415fdb4543e8c564dad437 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.wrapper','data' => ['disabled' => $isDisabled,'inlinePrefix' => $isPrefixInline,'inlineSuffix' => $isSuffixInline,'prefix' => $prefixLabel,'prefixActions' => $prefixActions,'prefixIcon' => $prefixIcon,'prefixIconColor' => $getPrefixIconColor(),'suffix' => $suffixLabel,'suffixActions' => $suffixActions,'suffixIcon' => $suffixIcon,'suffixIconColor' => $getSuffixIconColor(),'valid' => ! $errors->has($statePath),'attributes' => 
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class([
                    'fi-fo-phone-input',
                ])
        ,'xData' => '{}','xLoadCss' => '['.e($compiledCssUrl).']']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input.wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isDisabled),'inline-prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isPrefixInline),'inline-suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isSuffixInline),'prefix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixLabel),'prefix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixActions),'prefix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($prefixIcon),'prefix-icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getPrefixIconColor()),'suffix' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixLabel),'suffix-actions' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixActions),'suffix-icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($suffixIcon),'suffix-icon-color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($getSuffixIconColor()),'valid' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(! $errors->has($statePath)),'attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
            \Filament\Support\prepare_inherited_attributes($getExtraAttributeBag())
                ->class([
                    'fi-fo-phone-input',
                ])
        ),'x-data' => '{}','x-load-css' => '['.e($compiledCssUrl).']']); ?>
        <div
            wire:ignore
            dusk="phone-input.<?php echo e($id); ?>"
            class="inline-flex w-full"
        >
            <div
                class="w-full"
                x-ignore
                <?php if(FilamentView::hasSpaMode()): ?>
                    ax-load="visible || event (ax-modal-opened)" 
                <?php else: ?>
                    ax-load
                <?php endif; ?>
                ax-load-src="<?php echo e(\Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('filament-phone-input', package: 'ysfkaya/filament-phone-input')); ?>"
                x-data="phoneInputFormComponent({
                    options: {
                        allowDropdown: <?php echo \Illuminate\Support\Js::from($isAllowDropdown())->toHtml() ?>,
                        autoPlaceholder: <?php echo \Illuminate\Support\Js::from($getAutoPlaceholder())->toHtml() ?>,
                        containerClass: <?php echo \Illuminate\Support\Js::from($getContainerClass())->toHtml() ?>,
                        countryOrder: <?php echo \Illuminate\Support\Js::from($getCountryOrder())->toHtml() ?>,
                        countrySearch: <?php echo \Illuminate\Support\Js::from($isCountrySearch())->toHtml() ?>,
                        customPlaceholder: <?php echo \Illuminate\Support\Js::from($getCustomPlaceholder())->toHtml() ?>,
                        dropdownContainer: <?php echo \Illuminate\Support\Js::from($getDropdownContainer())->toHtml() ?>,
                        excludeCountries: <?php echo \Illuminate\Support\Js::from($getExcludeCountries())->toHtml() ?>,
                        fixDropdownWidth: <?php echo \Illuminate\Support\Js::from($isFixDropdownWidth())->toHtml() ?>,
                        formatAsYouType: <?php echo \Illuminate\Support\Js::from($isFormatAsYouType())->toHtml() ?>,
                        formatOnDisplay: <?php echo \Illuminate\Support\Js::from($isFormatOnDisplay())->toHtml() ?>,
                        performIpLookup: <?php echo \Illuminate\Support\Js::from($canPerformIpLookup())->toHtml() ?>,
                        i18n: <?php echo \Illuminate\Support\Js::from($getI18n())->toHtml() ?>,
                        initialCountry: <?php echo \Illuminate\Support\Js::from($getInitialCountry())->toHtml() ?>,
                        nationalMode: <?php echo \Illuminate\Support\Js::from($isNationalMode())->toHtml() ?>,
                        onlyCountries: <?php echo \Illuminate\Support\Js::from($getOnlyCountries())->toHtml() ?>,
                        placeholderNumberType: <?php echo \Illuminate\Support\Js::from($getPlaceholderNumberType())->toHtml() ?>,
                        showFlags: <?php echo \Illuminate\Support\Js::from($isShowFlags())->toHtml() ?>,
                        separateDialCode: <?php echo \Illuminate\Support\Js::from($isSeparateDialCode())->toHtml() ?>,
                        strictMode: <?php echo \Illuminate\Support\Js::from($isStrictMode())->toHtml() ?>,
                        useFullscreenPopup: <?php echo \Illuminate\Support\Js::from($isUseFullscreenPopup())->toHtml() ?>,
                        displayNumberFormat: <?php echo \Illuminate\Support\Js::from($getDisplayNumberFormat())->toHtml() ?>,
                        inputNumberFormat: <?php echo \Illuminate\Support\Js::from($getInputNumberFormat())->toHtml() ?>,
                        focusNumberFormat: <?php echo \Illuminate\Support\Js::from($getFocusNumberFormat())->toHtml() ?>,
                        ...<?php echo \Illuminate\Support\Js::from($getCustomOptions())->toHtml() ?>,
                    },
                    locale: <?php echo \Illuminate\Support\Js::from($getLocale())->toHtml() ?>,
                    intlTelInputSelectedCountryCookieName: <?php echo \Illuminate\Support\Js::from($getCookieName())->toHtml() ?>,
                    state: $wire.$entangle('<?php echo e($statePath); ?>'),
                    statePath: <?php echo \Illuminate\Support\Js::from($statePath)->toHtml() ?>,
                    isLive: <?php echo \Illuminate\Support\Js::from($isLive)->toHtml() ?>,
                    isLiveDebounced: <?php echo \Illuminate\Support\Js::from($isLiveDebounced)->toHtml() ?>,
                    isLiveOnBlur: <?php echo \Illuminate\Support\Js::from($isLiveOnBlur)->toHtml() ?>,
                    liveDebounce: <?php echo \Illuminate\Support\Js::from($liveDebounce)->toHtml() ?>,
                    <?php if($hasCountryStatePath() && $countryStatePath = $getCountryStatePath()): ?>
                        countryState: $wire.$entangle('<?php echo e($countryStatePath); ?>'),
                    <?php endif; ?>
                })"
            >
                <?php if (isset($component)) { $__componentOriginal9ad6b66c56a2379ee0ba04e1e358c61e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ad6b66c56a2379ee0ba04e1e358c61e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'filament::components.input.index','data' => ['xRef' => 'input','attributes' => 
                        \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                            ->merge([
                                'autofocus' => $isAutofocused(),
                                'disabled' => $isDisabled,
                                'id' => $id,
                                'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                                'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                                'placeholder' => $getPlaceholder(),
                                'required' => $isRequired() && (! $isConcealed),
                                'type' => 'tel',
                            ], escape: false)
                    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('filament::input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-ref' => 'input','attributes' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(
                        \Filament\Support\prepare_inherited_attributes($getExtraInputAttributeBag())
                            ->merge([
                                'autofocus' => $isAutofocused(),
                                'disabled' => $isDisabled,
                                'id' => $id,
                                'inlinePrefix' => $isPrefixInline && (count($prefixActions) || $prefixIcon || filled($prefixLabel)),
                                'inlineSuffix' => $isSuffixInline && (count($suffixActions) || $suffixIcon || filled($suffixLabel)),
                                'placeholder' => $getPlaceholder(),
                                'required' => $isRequired() && (! $isConcealed),
                                'type' => 'tel',
                            ], escape: false)
                    )]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ad6b66c56a2379ee0ba04e1e358c61e)): ?>
<?php $attributes = $__attributesOriginal9ad6b66c56a2379ee0ba04e1e358c61e; ?>
<?php unset($__attributesOriginal9ad6b66c56a2379ee0ba04e1e358c61e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ad6b66c56a2379ee0ba04e1e358c61e)): ?>
<?php $component = $__componentOriginal9ad6b66c56a2379ee0ba04e1e358c61e; ?>
<?php unset($__componentOriginal9ad6b66c56a2379ee0ba04e1e358c61e); ?>
<?php endif; ?>
            </div>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $attributes = $__attributesOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__attributesOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal505efd9768415fdb4543e8c564dad437)): ?>
<?php $component = $__componentOriginal505efd9768415fdb4543e8c564dad437; ?>
<?php unset($__componentOriginal505efd9768415fdb4543e8c564dad437); ?>
<?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>

<?php /**PATH /home/sajad/Laravel/API-Community-Platform/vendor/ysfkaya/filament-phone-input/src/../resources/views/phone-input.blade.php ENDPATH**/ ?>