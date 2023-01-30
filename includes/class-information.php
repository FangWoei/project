<?php

class Information
{
     /**
     * Retrieve all informations from database
     */
    public static function getAllInformations( $user_id )
    {
        // if is a normal user
        if ( Authentication::isUser() ) {
            return DB::connect()->select(
                'SELECT * FROM informations WHERE user_id = :user_id ORDER BY id DESC',
                [
                    'user_id' => $user_id
                ],
                true
            );
        }
        return DB::connect()->select(
            'SELECT * FROM informations ORDER BY id DESC',
            [],
            true
        );
    }

    /**
     * Retrieve information data by id
     */
    public static function getInformationByID( $information_id )
    {
        return DB::connect()->select(
            'SELECT * FROM informations WHERE id = :id',
            [
                'id' => $information_id
            ]
        );
    }
    
    /**
     * Retrieve all the publish informations
     */
    public static function getPublishInformations()
    {
        return DB::connect()->select(
            'SELECT * FROM informations WHERE status = :status ORDER BY id DESC',
            [
                'status' => 'publish'
            ],
            true
        );
    }

    /**
     * Add new information
     */
    public static function add( $student_name, $email, $phone_number, $gender, $student_ID, $entry_year, $content, $user_id )
    {
        return DB::connect()->insert(
            'INSERT INTO informations (student_name, email, phone_number, gender, student_ID, entry_year, content, user_id ) 
            VALUES (:student_name, :email, :phone_number, :gender, :student_ID, :entry_year, :content, :user_id )',
            [
                'student_name' => $student_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'gender' => $gender,
                'student_ID' => $student_ID,
                'entry_year' => $entry_year,
                'content' => $content,
                'user_id' => $user_id
            ]
        );
    }

    /**
     * Update information details
     */
    public static function update( $id, $student_name, $email, $phone_number, $gender, $student_ID, $entry_year, $content, $status )
    {

        // update user data into the database
        return DB::connect()->update(
            'UPDATE informations SET 
            student_name = :student_name, email = :email, phone_number = :phone_number, gender = :gender, student_ID = :student_ID, entry_year = :entry_year, content = :content, status = :status
            WHERE id = :id',
            [
                'id' => $id,
                'student_name' => $student_name,
                'email' => $email,
                'phone_number' => $phone_number,
                'gender' => $gender,
                'student_ID' => $student_ID,
                'entry_year' => $entry_year,
                'content' => $content,
                'status' => $status
            ]
        );
    }

    /**
     * Delete information
     */
    public static function delete( $information_id )
    {
        return DB::connect()->delete(
            'DELETE FROM informations where id = :id',
            [
                'id' => $information_id
            ]
        );
    }
}