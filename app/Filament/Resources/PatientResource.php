<?php

namespace App\Filament\Resources;

use App\Enums\CivilStatus;
use App\Enums\Nationality;
use App\Enums\Sex;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Barangay;
use App\Models\Cities;
use App\Models\IpGroup;
use App\Models\Patient;
use App\Models\Province;
use App\Models\Region;
use App\Models\Relationship;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions;

use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\Filter;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationLabel = 'Patient Registration';

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->schema([

                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->helperText('Upload imgage here'),

                        TextInput::make('old_hospital_number')
                            ->label('Old Hospital Number'),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('suffix')
                            ->label('Suffix'),
                        TextInput::make('alias')
                            ->label('Alias'),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->columnSpanFull(),
                        TextInput::make('maiden_name')
                            ->label('Maiden Name')
                            ->columnSpanFull(),
                        DatePicker::make('date_of_birth')
                            ->label('Birth Date')
                            ->required(),
                        Select::make('sex')
                            ->label('Sex')
                            ->options(Sex::class)
                            ->required(),
                        Select::make('civil_status')
                            ->label('Civil Status')
                            ->options(CivilStatus::class)
                            ->required(),
                        Textarea::make('place_of_birth'),
                        Select::make('blood_type')
                            ->label('Blood Type')
                            ->options([
                                'A+' => 'A+',
                                'B+' => 'B+',
                                'AB+' => 'AB+',
                                'O+' => 'O+',
                                'A' => 'A+',
                                'B-' => 'B-',
                                'AB-' => 'AB-',
                                'O-' => 'O-'
                            ])
                            ->searchable()
                            ->required(),
                        TextInput::make('nationality')
                            ->label('Nationality'),
                        Select::make('if_indigenous')
                            ->label('If indigenous please select')
                            ->options(IpGroup::query()->pluck('name', 'id'))
                            ->searchable(),
                        Select::make('employment_status')
                            ->label('Employment Status')
                            ->options([
                                'Employed' => 'Employed',
                                'Unemployed' => 'Unemployed',
                                'Self Employed' => 'Self Employed'
                            ])
                            ->searchable(),
                        Section::make()
                            // ->schema([
                            //     Repeater::make('occupations')
                            //         ->relationship()
                            //         ->schema([
                            //             TextInput::make('occupation')
                            //                 ->label('Occupation')
                            //                 ->placeholder('Occupation')
                            //                 ->required(),
                            //             TextInput::make('employer')
                            //                 ->label('Employer')
                            //                 ->placeholder('Employer'),
                            //             TextInput::make('employer_email_address')
                            //                 ->label('Email')
                            //                 ->email()
                            //                 ->placeholder('Employer email address'),
                            //             TextInput::make('employer_telephone_number')
                            //                 ->label('Telephone Number')
                            //                 ->numeric()
                            //                 ->placeholder('Employer Telephone Number'),
                            //             TextInput::make('branch_station')
                            //                 ->label('Branch/Station')
                            //                 ->placeholder('Employer Branch/Station'),
                            //             TextInput::make('employer_address')
                            //                 ->label('Address')
                            //                 ->placeholder('Employer Address'),
                            //         ])->columns(2)
                            //         ->defaultItems(0)
                            //         ->collapsible(),
                            //     Repeater::make('contacts')
                            //         ->relationship()
                            //         ->schema([
                            //             TextInput::make('telephone_number')
                            //                 ->label('Telephone Number')
                            //                 ->numeric()
                            //                 ->required()
                            //                 ->placeholder('Telephone number'),
                            //             Select::make('telephone_type')
                            //                 ->label('Type of Telephone')
                            //                 ->placeholder('Type of Telephone')
                            //                 ->options([
                            //                     'Residence' => 'Residence',
                            //                     'Office' => 'Office',
                            //                     'School' => 'School',
                            //                     'Celluar phone' => 'Celluar phone',
                            //                 ])
                            //         ])->columns(2)
                            //         ->collapsible()
                            //         ->defaultItems(0)
                            // ]),
                    ])->columns(2)

                    ->collapsible(),
                Section::make('Demographic Information')
                    ->schema([
                        Section::make('Persent Address')
                            ->schema([
                                Textarea::make('present_street_number')
                                    ->label('No. Street')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('present_region_code')
                                    ->label('Region')
                                    ->options(Region::orderBy('name', 'ASC')->pluck('name', 'region_code'))
                                    ->searchable(),
                                Select::make('present_province_code')
                                    ->label('Province')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Province::where('region_code', $get('present_region_code'))->pluck('name', 'province_code');
                                    })
                                    ->searchable(),
                                Select::make('present_city_code')
                                    ->label('Municipality')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Cities::where('province_code', $get('present_province_code'))->pluck('name', 'city_code');
                                    })
                                    ->searchable(),
                                Select::make('present_barangay_code')
                                    ->label('Barangay')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Barangay::where('city_code', $get('present_city_code'))->pluck('name', 'psgc_code');
                                    })
                                    ->searchable(),
                                TextInput::make('present_zip_code')
                                    ->label('Zip Code'),
                            ])->columns(2),


                        Checkbox::make('same_as_current')
                            ->label(':Check if the permanent address is same as above.')
                            ->live()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                if ($state) {
                                    $set('permanent_street_number', $get('present_street_number'));
                                    $set('permanent_region_code', $get('present_region_code'));
                                    $set('permanent_province_code', $get('present_province_code'));
                                    $set('permanent_city_code', $get('present_city_code'));
                                    $set('permanent_barangay_code', $get('present_barangay_code'));
                                    $set('permanent_zip_code', $get('present_zip_code'));
                                } else {
                                    $set('permanent_street_number', '');
                                    $set('permanent_region_code', '');
                                    $set('permanent_province_code', '');
                                    $set('permanent_city_code', '');
                                    $set('permanent_barangay_code', '');
                                    $set('permanent_zip_code', '');
                                }
                            }),

                        Section::make('Permanent Address')
                            ->schema([
                                Textarea::make('permanent_street_number')
                                    ->label('No. Street')
                                    ->required()
                                    ->columnSpanFull(),
                                Select::make('permanent_region_code')
                                    ->label('Region')
                                    ->options(Region::orderBy('name', 'ASC')->pluck('name', 'region_code'))
                                    ->searchable(),
                                Select::make('permanent_province_code')
                                    ->label('Province')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Province::where('region_code', $get('permanent_region_code'))->pluck('name', 'province_code');
                                    })
                                    ->searchable(),
                                Select::make('permanent_city_code')
                                    ->label('Municipality')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Cities::where('province_code', $get('permanent_province_code'))->pluck('name', 'city_code');
                                    })
                                    ->searchable(),
                                Select::make('permanent_barangay_code')
                                    ->label('Barangay')
                                    ->required()
                                    ->options(function (Get $get) {
                                        return  Barangay::where('city_code', $get('permanent_city_code'))->pluck('name', 'psgc_code');
                                    })
                                    ->searchable(),
                                TextInput::make('permanent_zip_code')
                                    ->label('Zip Code'),
                            ])->columns(2),
                    ])
                    ->columns(2)
                    ->collapsible(),
                Group::make()
                    ->schema([
                        Section::make('Contact Person')
                            ->schema([
                                TextInput::make('contact_person_name')
                                    ->label('Contact Name')
                                    ->columnSpanFull(),
                                TextInput::make('contact_person_address')
                                    ->label('Address')
                                    ->columnSpanFull(),
                                TextInput::make('contact_person_mobile_tel_number')
                                    ->numeric()
                                    ->label('Mobile Number'),
                                Select::make('relationship')
                                    ->label('Relationship')
                                    ->options(Relationship::orderBy('name', 'ASC')->pluck('name', 'id'))
                                    ->searchable(),
                            ])
                            ->columns(2)
                            ->collapsible()
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Spouse')
                            ->schema([
                                TextInput::make('spouse_last_name')
                                    ->label('Last Name'),
                                TextInput::make('spouse_first_name')
                                    ->label('First Name'),
                                TextInput::make('spouse_middle_name')
                                    ->label('Middle Name'),
                                TextInput::make('spouse_address')
                                    ->label('Address'),
                                TextInput::make('spouse_mobile_tel_number')
                                    ->label('Mobile Number')
                                    ->numeric(),
                                Select::make('spouse_is_deceased')
                                    ->label('Deceased?')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No'
                                    ]),
                            ])
                            ->collapsible()
                            ->columns(2)
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Father Information')
                            ->schema([
                                TextInput::make('fathers_last_name')
                                    ->label('Last Name'),
                                TextInput::make('fathers_first_name')
                                    ->label('First Name'),
                                TextInput::make('fathers_middle_name')
                                    ->label('Middle Name'),
                                TextInput::make('fathers_suffix')
                                    ->label('Suffix'),
                                TextInput::make('fathers_address')
                                    ->label('Address'),
                                TextInput::make('fathers_mobile_tel_number')
                                    ->label('Mobile Number')
                                    ->numeric(),
                                Select::make('fathers_is_deceased')
                                    ->label('Deceased?')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No'
                                    ]),
                            ])
                            ->collapsible()
                            ->columns(2),
                    ]),
                Group::make()
                    ->schema([
                        Section::make('Mother Information')
                            ->schema([
                                TextInput::make('mothers_last_name')
                                    ->label('Last Name'),
                                TextInput::make('mothers_first_name')
                                    ->label('First Name'),
                                TextInput::make('mothers_middle_name')
                                    ->label('Middle Name'),
                                TextInput::make('mothers_address')
                                    ->label('Address'),
                                TextInput::make('mothers_mobile_tel_number')
                                    ->label('Mobile Number')
                                    ->numeric(),
                                Select::make('mothers_is_deceased')
                                    ->label('Deceased?')
                                    ->options([
                                        'yes' => 'Yes',
                                        'no' => 'No'
                                    ]),
                            ])
                            ->collapsible()
                            ->columns(2),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('photo')
                    ->circular()
                    ->height(50),
                TextColumn::make('last_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('suffix'),
                TextColumn::make('first_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('middle_name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('date_of_birth')
                ->label('Date of Birth')
                ->date(),
                TextColumn::make('sex')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('civil_status')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Filter::make('civil_status'),
                Filter::make('sex'),
                Filter::make('last_name'),
                Filter::make('first_name'),
           
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                ViewAction::make()
                ->form([
                    Section::make('Basic Information')
                    ->schema([
                        FileUpload::make('image')
                            ->image()
                            ->imageEditor()
                            ->helperText('Upload imgage here'),
                        TextInput::make('old_hospital_number')
                            ->label('Old Hospital Number'),
                        TextInput::make('last_name')
                            ->label('Last Name')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('first_name')
                            ->label('First Name')
                            ->required()
                            ->columnSpanFull(),
                        TextInput::make('suffix')
                            ->label('Suffix'),
                        TextInput::make('middle_name')
                            ->label('Middle Name')
                            ->columnSpanFull(),
                        DatePicker::make('date_of_birth')
                            ->label('Birth Date')
                            ->required(),
                    ]),
                    
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
