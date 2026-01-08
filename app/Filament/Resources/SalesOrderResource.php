<?php

namespace App\Filament\Resources;

use App\Data\RegionData;
use Dom\Text;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\SalesOrder;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\SalesOrderResource\Pages;
use App\Filament\Resources\SalesOrderResource\RelationManagers;
use App\Services\RegionQueryService;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Support\Number;
use Symfony\Polyfill\Intl\Idn\Info;

class SalesOrderResource extends Resource
{
    protected static ?string $model = SalesOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Sales Order General Information')
                    ->description('Meta & Customer Information')
                    ->schema([
                        TextEntry::make('trx_id')
                            ->label('TRX ID')
                            ->inlineLabel(),

                        TextEntry::make('status')
                            ->formatStateUsing(fn($state) => $state->label())
                            ->inlineLabel(),

                        TextEntry::make('due_date_at')
                            ->label('Due Date')
                            ->inlineLabel(),

                        TextEntry::make('customer_full_name')
                            ->label('Name')
                            ->inlineLabel(),

                        TextEntry::make('customer_email')
                            ->label('Email')
                            ->inlineLabel(),

                        TextEntry::make('customer_phone')
                            ->label('Phone')
                            ->inlineLabel(),

                        TextEntry::make('address_line')
                            ->label('Shipping Address')
                            ->inlineLabel()
                            ->formatStateUsing(function ($state, Salesorder $sales_order) {
                                $region = app(RegionQueryService::class)->searchRegionByCode(
                                    $sales_order->destination_code
                                );

                                return "$state {$region->label}";
                            })
                    ]),

                Section::make('Shipping Details')
                    ->collapsed()
                    ->schema([
                        TextEntry::make('shipping_driver')
                            ->label('Driver')
                            ->inlineLabel(),
                        TextEntry::make('shipping_courier')
                            ->label('Courier')
                            ->inlineLabel(),
                        TextEntry::make('shipping_service')
                            ->label('Service')
                            ->inlineLabel(),
                        TextEntry::make('shipping_estimated_delivery')
                            ->label('Estimated Delivery')
                            ->inlineLabel(),
                        TextEntry::make('shipping_weight')
                            ->label('Weight')
                            ->suffix(' gr')
                            ->inlineLabel(),
                        TextEntry::make('shipping_receipt_number')
                            ->label('Receipt Number')
                            ->inlineLabel(),
                        TextEntry::make('shipping_cost')
                            ->label('Cost')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                    ]),

                RepeatableEntry::make('items')
                    ->label('Order Items')
                    ->schema([
                        TextEntry::make('name')
                            ->formatStateUsing(fn($state, Model $record) => "({$record->sku}) $state"),
                        TextEntry::make('quantity'),
                        TextEntry::make('price')
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                        TextEntry::make('total')
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                    ])
                    ->hiddenLabel()
                    ->columnSpanFull()
                    ->columns(4),

                Section::make('Summaries')
                    ->schema([
                        TextEntry::make('payment_label')
                            ->label('Payment Method')
                            ->inlineLabel(),
                        TextEntry::make('payment_paid_at')
                            ->label('Paid At')
                            ->inlineLabel(),
                        TextEntry::make('sub_total')
                            ->label('Subtotal')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                        TextEntry::make('shipping_total')
                            ->label('Shipping Cost')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                        TextEntry::make('total')
                            ->label('Total')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => Number::currency($state)),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('trx_id'),
                TextColumn::make('customer_full_name'),
                TextColumn::make('status')
                    ->formatStateUsing(fn($state) => $state->label()),
                TextColumn::make('total')
                    ->formatStateUsing(fn($state) => Number::currency($state)),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSalesOrders::route('/'),
            'view' => Pages\ViewSalesOrder::route('/{record}'),
        ];
    }
}
