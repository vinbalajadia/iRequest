<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DocumentRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'request_number',
        'student_id',
        'document_type',
        'purpose',
        'status',
        'admin_remarks',
        'processed_at',
        'ready_at',
        'completed_at',
        'processed_by',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'ready_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    const DOCUMENT_TYPES = [
        'transcript_of_records' => 'Transcript of Records',
        'diploma' => 'Diploma',
        'certificate_of_enrollment' => 'Certificate of Enrollment',
        'good_moral_certificate' => 'Good Moral Certificate',
        'clearance' => 'Clearance',
        'others' => 'Others',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_APPROVED = 'approved';
    const STATUS_READY_FOR_PICKUP = 'ready_for_pickup';
    const STATUS_REJECTED = 'rejected';
    const STATUS_COMPLETED = 'completed';

    const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_PROCESSING => 'Processing',
        self::STATUS_APPROVED => 'Approved',
        self::STATUS_READY_FOR_PICKUP => 'Ready for Pickup',
        self::STATUS_REJECTED => 'Rejected',
        self::STATUS_COMPLETED => 'Completed',
    ];

    //Relationships
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function processedBy()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    //Accesors and Mutators
    public function getDocumentTypeNameAttribute()
    {
        return self::DOCUMENT_TYPES[$this->document_type] ?? $this->document_type;
    }

    public function getStatusNameAttribute()
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            self::STATUS_PENDING => 'badge bg-warning',
            self::STATUS_PROCESSING => 'badge bg-info',
            self::STATUS_APPROVED => 'badge bg-primary',
            self::STATUS_READY_FOR_PICKUP => 'badge bg-success',
            self::STATUS_REJECTED => 'badge bg-danger',
            self::STATUS_COMPLETED => 'badge bg-secondary',
            default => 'badge bg-secondary',
        };
    }

    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y h:i A');
    }

    public function getProcessingTimeAttribute()
    {
        if (!$this->completed_at)
            return $this->created_at->diffForHumans();

        return $this->created_at->diffInDays($this->completed_at) . ' days';
    }

    public function getCanBeCancelledAnytime()
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }

    public function getIsActiveAttribute()
    {
        return in_array($this->status, [self::STATUS_COMPLETED, self::STATUS_REJECTED]);
    }

    public function getEstimatedCompletionAttribute()
    {
        if ($this->status === self::STATUS_COMPLETED) {
            return null;
        }

        $processingDays = match ($this->document_type) {
            'transcript_of_records' => 7,
            'diploma' => 14,
            'certificate_of_enrollment' => 3,
            'good_moral_certificate' => 3,
            'clearance' => 5,
            default => 5,
        };

        return $this->created_at->addDays($processingDays);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDocument($query, $documentType)
    {
        return $query->where('document_type', $documentType);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    public function scopeActive($query)
    {
        return $query->where('status', [self::STATUS_COMPLETED, self::STATUS_REJECTED]);
    }

    public function scopeByStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }

    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    public function scopeOverDue($query)
    {
        return $query->where('created_at', '<=', now()->subDays(14))
            ->whereIn('status', [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }

    //Business Methods
    public function canBeProcessed()
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function canBeApproved()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    public function canBeRejected()
    {
        return in_array($this->status, [self::STATUS_PENDING, self::STATUS_PROCESSING]);
    }

    public function canBeMarkedReady()
    {
        return $this->status === self::STATUS_APPROVED;
    }

    public function canBeCompleted()
    {
        return $this->status === self::STATUS_READY_FOR_PICKUP;
    }

    public function updateStatus($newStatus, $adminRemarks = null, $adminId = null)
    {
        $oldStatus = $this->status;

        $this->status = $newStatus;
        $this->processed_by = $adminId ?? auth('admin')->id();

        if ($adminRemarks)
            $this->admin_remarks = $adminRemarks;

        switch ($newStatus) {
            case self::STATUS_PROCESSING:
                $this->processed_at = now();
                break;
            case self::STATUS_READY_FOR_PICKUP:
                $this->ready_at = now();
                break;
            case self::STATUS_COMPLETED:
                $this->completed_at = now();
                break;
        }

        $this->save();

        Log::info("Request {$this->request_number} status changed from {$oldStatus} to {$newStatus}");

        return $this;
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($request) {
            Log::info("New Document Request created: {$request->request_number}");
        });

        static::updated(function ($request) {
            Log::info("Request {$request->request_number} status updated to: {$request->status}");
        });
    }
}
