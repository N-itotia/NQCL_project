-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2017 at 07:12 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `enqcl2`
--

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE IF NOT EXISTS `issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `issue` text NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `whose` varchar(80) NOT NULL,
  `time_sorted` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `developer` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `issue`
--

INSERT INTO `issue` (`id`, `title`, `issue`, `date_time`, `whose`, `time_sorted`, `user_id`, `developer`, `comment`, `status`) VALUES
(3, 'DASHBOARD TOOLBAR DOES MISSING', 'Upon logging in, I expect the black/grey toolbar that contains the dashboard to appear. In some cases it does not; what do I do?', '2015-04-13 07:39:41', 'Dr.Rebecca Manani', '2015-04-13', 94, 'Watson', 'To access black menu bar, user should login as Doc Control Role', 1),
(4, ' 404 Page Not Found  The page you requested was no', 'I''m reviewing NDQD201502076 and on trying to download it gives that error ', '2015-04-13 08:15:29', 'Dr.George Wang''ang''a', '2015-04-13', 107, 'Alphonce', 'Apparently NDQD201502076 Sample was not done via the LIMS hence the missing worksheet. Kindly check with the concern Analyst', 1),
(5, 'Identification Specifications and Description', 'The information for specifications is appearing under description and vice varsa', '2015-04-13 10:58:59', 'Dr.Ernest Mbae', '2015-04-23', 57, 'Alphonce', 'I have already worked on the issue, it should be okey moving forward', 1),
(6, 'OOS INVESTIGATION', 'We need to track samples even when going through OOS investigation: please enable this through LIMS.', '2015-04-13 11:38:31', 'Dr.Rebecca Manani', '2015-08-06', 94, 'Alphonce', 'Noted, process to take care of oos samples has  been initiated', 1),
(7, 'Identification Specifications and Description', 'The default statements for both the specifications and the description have changed for NDQD201404394', '2015-04-13 11:48:17', 'Dr.Ernest Mbae', '2015-04-14', 57, 'Alphonce', 'I made an update on the server, samples which will come for supervision from today will not face that problem', 1),
(8, 'Sample Request', 'Initial view should be only for the current year samples.', '2015-04-13 12:07:38', 'Dr.Ernest Mbae', '2015-04-23', 57, 'Watson', 'Filtered initial list to include only samples added in the current year. Added a link (All Samples) to a list including current year and other year samples.', 1),
(9, 'Error', 'NDQD201412986 is to be updated on the tracking since it was not issued through the LIMS, but it gives an error.', '2015-04-13 13:01:25', 'Dr.George Wang''ang''a', '2015-04-14', 107, 'Alphonce', 'The tracking of non-LIMS samples is done manualy by someone at documentation, possibly in Dr. Kefa''s office, Please liaise with documentation regarding that. ', 1),
(10, 'Excel spreadsheet', 'The spreadsheet for samples whose label claim is international units was used for a sample whose label claim was in mg. NDQD201404394', '2015-04-13 13:06:15', 'Dr.Ernest Mbae', '2015-04-14', 57, 'Alphonce', 'Kindly take up the issue with documentation and the concern Analyst - No LIMS records show that the sample was either received or done by the LIMS. The Sample is also ancient as per the time operations begun. Thank you.', 1),
(11, 'Excel spreadsheet', 'The excel spreadsheets are not locked.', '2015-04-13 14:18:42', 'Dr.Ernest Mbae', '2015-04-23', 57, 'Alphonce', 'We discussed and agreed that if its possible to track changes on the template itself, then there would be no need to lock the cells.', 1),
(12, 'Uploading COA ', 'worksheet NDQD201502081 on uploading after review does bring results for update of the COA ', '2015-04-14 08:48:41', 'Dr.George Wang''ang''a', '2015-04-14', 107, 'Alphonce', 'The results were unfortunately unavailable because the concern analyst had deleted some top cells unknowingly from the worksheet making it unreadable to the LIMS - I shall work on restricting cell delets.', 1),
(13, 'Repitition is of the highest order', 'Since every detail is incorporated in LIMS, I suggest we only print out the the first page of the hardcopy worksheet, attach weights on it and clip this to the chromatograms obtained.', '2015-04-14 09:16:16', 'Mr.Michael Sangale', '2015-08-06', 55, 'Alphonce', 'Noted, that is the current procedure.', 0),
(14, 'Results Interchange ', 'NDQD201503139 Assay and Dissolution results have interchanged. ', '2015-04-14 11:41:32', 'Dr.George Wang''ang''a', '2015-04-14', 107, 'Alphonce', 'There was a small problem in the picking of the results - Rectified', 1),
(15, 'Supervisor view', 'I should be able to go back to the supervisor home automatically after approving all the tests for a sample', '2015-04-14 13:08:10', 'Dr.Ernest Mbae', '2015-04-23', 57, 'Alphonce', 'The functionality should be up before the end of tomorrow, i found a work around.', 1),
(16, 'Manufacturer and Exipry Date', 'Lmis  shows full date instead of month and year - the month be written in words.', '2015-04-15 08:51:25', 'MsEunice Shankil', '2015-04-23', 73, 'Watson', 'Explained that lims captures whether the date of manufacture and the date of expiry is day-month-year or month-year. We can, using this information ,display these two dates however they are required.', 1),
(17, 'Multiple  entries', 'NDQD201502086 & 085 have multiple entries for identification and assay', '2015-04-15 12:12:00', 'Dr.George Wang''ang''a', '2015-08-06', 107, 'Alphonce', 'I have cleared the multiple entries and put a constraint in place to avoid that, the analyst was making entries three times for multiple componets which should not be the case.', 1),
(18, 'Multiple entries', 'NDQD201502086 & 085 have multiple entries for identification and assay\r\n\r\nPS i tried to edit my previous entry to add the 085 but i seem not to be able to re-submit the issue once edited', '2015-04-15 12:16:23', 'Dr.George Wang''ang''a', '2015-04-23', 107, 'Alphonce', 'I have sorted the multiple entries, I will ask the analysts not to do double entry for assay and identification if its multi-component but rather combine the results on a single area, the multiple entries is like they did a repeat, which is not correct.', 1),
(19, 'Upload Correction', 'NDQD201502078 this worksheet now has an extra test performed which requires additional parameters on the COA', '2015-04-15 13:05:38', 'Dr.George Wang''ang''a', '2015-08-06', 107, 'Alphonce', 'fixed', 1),
(20, 'MISLABELLED EXCEL SHEET', 'CREAMS OINTMENT AND GELS LABELLED AS G/ML JUST LEAVE IT WITHOUT UNITS', '2015-04-16 08:31:35', 'Dr.Eric Mutua', '2015-04-16', 84, 'Alphonce', 'Dr. Mbae Corrected the Labeling, please check again', 1),
(21, 'Upload XCel Sheets', 'I need a menu to upload xcel sheets', '2015-04-16 08:34:41', 'Dr.Ernest Mbae', '2015-04-17', 57, 'Alphonce', 'Menu Added', 1),
(22, 'Upload Error', 'NDQD201403295 has two assay results and none is updating', '2015-04-16 09:58:30', 'Dr.George Wang''ang''a', '2015-04-17', 107, 'Alphonce', 'Please try to use the upload edited workbook and see if it does update,I made a correction, If it does not please re-open this issue', 1),
(23, 'SAMPLE REASSIGNMENT TO ANALYSTS', 'Re-issuing a sample to wet chemistry entails prior withdrawal from all analysts issued, including microbiology. This basically means we have to reissue to all the analysts again - this is a lot of work, and may bring about errors in dates etc. Please device a more intuitive way of editing this.', '2015-04-16 10:10:04', 'Dr.Rebecca Manani', '2015-04-23', 94, 'Watson', 'Trained concerned user - Dr. Rebecca on how to successfully withdraw a sample from the affected department without having to withdraw it from the other. ', 1),
(24, 'Error on updating Identification results', '41\r\nFatal error: Call to undefined method Identification::count_test_done() in C:\\LIMS\\htdocs\\NQCL\\application\\controllers\\identification.php on line 82', '2015-04-17 10:36:27', 'Dr.Ernest Mbae', '2015-04-17', 57, 'Alphonce', 'Update added - Error fixed.', 1),
(25, 'Reject process', 'The reject process semms not to be working for worksheets NDQD201410913', '2015-04-20 06:55:25', 'Dr.Ernest Mbae', '2015-04-23', 57, 'Alphonce', 'I am working on that rejection process', 1),
(26, 'Upload error', 'NDQD201410914 the results at point of upload have interchanged - Dissolution and Assay', '2015-04-23 08:22:33', 'Dr.George Wang''ang''a', '2015-04-23', 107, 'Alphonce', 'I have sorted the error, please try and reload the review page, all should be well...', 1),
(27, 'Error while downloading worksheet', 'hereFPDF error: Cannot open worksheets/NDQD201405427.pdf !\r\n\r\nI would like to bring to your attention the error message copy pasted above that appears when I try to download worksheets. Kindly address.\r\n\r\n', '2015-04-23 10:16:29', 'Mr.Eric Ngamau', '2015-05-07', 86, 'Alphonce', 'Was sorted', 1),
(28, 'two sets of results', 'NDQD201502078 has an extra component. Can we have it part of the results to be uploaded', '2015-04-24 09:46:42', 'Dr.George Wang''ang''a', '2015-05-07', 107, 'Alphonce', 'I have shown a work around', 1),
(29, 'WUOTATION ERRORS', 'When creating a new quotation for an existent client, the system adds the quote (and therefore the total sum) to previous quotations. Not possible to create an entirely new quotation for a client that we have handles earlier.', '2015-04-24 10:57:46', 'Dr.Rebecca Manani', '2015-06-09', 94, 'Watson', 'Now system only adds amount of previous quotation to the current quotation if the user has so chosen. If the user wishes to create an entirely new quotation they select  the ''New'' option on the the first window of quotation creation.', 1),
(30, 'QUOTATION EDITING', 'Can the system create allowance for quotation editing? Important in cases where we realize the final figure in the printing platform is erroneous. ', '2015-04-24 11:46:45', 'Dr.Rebecca Manani', '0000-00-00', 94, 'Watson', '', 0),
(31, 'UNDO BUTTON', 'Please enable the user to undo e.g. when withdrawing a sample by mistake, change number of vials or tablets issued to analyst etc.', '2015-04-27 10:54:04', 'Dr.Rebecca Manani', '0000-00-00', 94, 'Watson', '', 0),
(32, 'Sample Information Form', 'Name and address of the client should not be printed on the form', '2015-04-28 07:12:03', 'Dr.Ernest Mbae', '2015-05-07', 57, 'Alphonce', 'I have removed the printing of the address', 1),
(33, 'SAMPLE WITHDRAWAL FROM ANALYSTS', 'We need to have a record of samples withdrawn from analysts together with reasons for withdrawal e.g. lack of reagent, lack of CRS, etc.', '2015-04-28 10:01:20', 'Dr.Rebecca Manani', '0000-00-00', 94, 'Watson', '', 0),
(34, 'Cannot Upload Edited Workbook', 'On clicking "Upload Edited Workbook", the following message is indicated; "Kindly only upload NDQD*******.xlsx file!" even before selecting a file.', '2015-05-05 10:37:04', 'Dr.Emmanuel Tanui', '2015-08-06', 77, 'Alphonce', 'fixed', 1),
(35, 'Database Error on Upload', 'The following error is displayed on trying to upload an editted workbook:\r\n\r\n"A Database Error Occurred\r\n\r\nError Number: 1146\r\n\r\nTable ''enqcl2.generic_worksheet'' doesn''t exist\r\n\r\nSELECT * FROM (`generic_worksheet`) WHERE `wk_no` = 7195.5\r\n\r\nFilename: C:\\LIMS\\htdocs\\NQCL\\system\\database\\DB_driver.php\r\n\r\nLine Number: 330"\r\n', '2015-05-06 08:59:32', 'Dr.Emmanuel Tanui', '2015-08-06', 77, 'Alphonce', 'Error fixed', 1),
(36, 'Supervisor function', 'The reject button and the message are not working', '2015-05-06 13:20:39', 'Dr.Ernest Mbae', '2015-08-06', 57, 'Alphonce', 'fixed', 1),
(37, 'Approval Worksheets', 'Worksheet NDQD201502070 initially approved partially by one supervisor not working when re issued to a second supervisor', '2015-05-18 10:13:31', 'Dr.Ernest Mbae', '2015-08-12', 57, 'Alphonce', 'I will have a look at the reason why that is happening and fix it as soon as possible', 1),
(38, 'Worksheet download option', 'NDQB201501048 has no option for download of LAL worksheet.', '2015-05-19 06:21:51', 'Mr.Eric Ngamau', '2015-05-26', 86, 'Alphonce', 'The option has been added', 1),
(39, 'Missing Values', 'After upload, the worksheet has no data to upload NDQD201505239 and also NDQD201503151', '2015-05-26 11:22:20', 'Dr.George Wang''ang''a', '2015-08-06', 107, 'Alphonce', 'fixed', 1),
(40, 'Drafts', 'Loosing data from drafts upon submitting to reviewer i.e received date, sample description.', '2015-05-27 04:54:02', 'MsGladys Bogonko', '2015-06-24', 71, 'Alphonce', 'issue fixed', 1),
(41, 'Drafts', 're- submitting rejected drafts', '2015-05-27 04:55:00', 'MsGladys Bogonko', '2015-06-24', 71, 'Alphonce', 'fixed', 1),
(42, 'Drafts', 'Removing drafts drafts which cant be processed through LIMS from the reviewed list ', '2015-05-27 04:56:40', 'MsGladys Bogonko', '2015-09-07', 71, 'Alphonce', 'The functionality is now available', 1),
(43, 'Drafts', 'Adding or removing the analyst names from the drats', '2015-05-27 04:57:53', 'MsGladys Bogonko', '2015-09-07', 71, 'Alphonce', 'Already Sorted and working', 1),
(44, 'NDQD 201506271 - New entry ', 'not been saved', '2015-06-05 08:47:33', 'MsAnastasia Ngumbi', '2015-06-09', 74, 'Watson', 'New Entry now saved.', 1),
(45, 'DATA ENTRY( SUPERSCRIPT AND SUBSCRPT)', 'Not able to enter as superscript or subscript.', '2015-06-05 08:49:43', 'MsAnastasia Ngumbi', '2015-07-22', 74, 'Watson', 'Agreed this is to be done at the point the data is in Excel. Much more intuitive. Same goes for all other special symbols.', 1),
(46, 'SUPERVISORS', 'Dr. Kwena does not feature as one of the analysts'' supervisors; please include him in the list urgently.', '2015-06-05 12:00:52', 'Dr.Rebecca Manani', '2015-06-22', 94, 'Alphonce', 'included', 1),
(47, 'OOS INVESTIGATION STEP', 'We need OOS investigation step included in the sample cycle. It needs to appear twice: Issuing-Analysis-Supervision-OOS INVESTIGATION-Review-OOS INVESTIGATION-COA draft etc etc. Please treat this as urgent.', '2015-06-05 12:15:29', 'Dr.Rebecca Manani', '2015-08-06', 94, 'Alphonce', 'Fixed', 1),
(48, ' counter requisition', 'Kindly see how to  include counter requisition   and issue voucher (S II )', '2015-06-09 08:01:41', ' ', '2015-07-22', 0, 'Watson', 'Added S11, S13 vouchers to the reagents entry form', 1),
(49, 'CoA change log', 'There needs to be a facility to view the change log of the CoA in the review of CoA and the Director''s veiws.', '2015-06-16 17:03:18', 'Dr.Ernest Mbae', '2015-07-02', 57, 'Alphonce', 'Working', 1),
(50, 'Repitition is of the highest order', '1. Entry of the monograph should be once & Once entered doesn''t appear on the final worksheet\r\n2. The chromatographic conditions once entered doesn''t appear on the final worksheet\r\n3. The sample description and packaging parts do not appear on the LIMS...already edited\r\n4. On the reagents data entry the expiry date should be included\r\n5. On the equipment data entry dates of calibration and due calibration needs to be included\r\n6. The Dissolution data entry doesn''t appear on the final worksheet genrated\r\n\r\n\r\n\r\n\r\n', '2015-06-19 12:09:35', 'Mr.Michael Sangale', '2015-08-06', 55, 'Alphonce', 'Noted, Issues 5 & 4 are underway', 1),
(51, 'Kindly include pieces in Lims quantity', 'kindly include pieces and numbers in the Lims quantity', '2015-07-06 06:59:24', 'Mr.Wilson Onyango', '2015-08-06', 104, 'Alphonce', 'Included pieces as a an option to quantify some items', 0),
(52, 'Generating Completed Worksheet', 'FPDF error: Cannot open worksheets_completed/NDQD201504179.pdf !\r\n\r\nAfter filling the worksheet online, the error above is displayed when trying to download the completed worksheet. Kindly assist.', '2015-07-08 09:07:51', 'Mr.Eric Ngamau', '2015-09-07', 86, 'Alphonce', 'Already worked on the above issue, please try again', 1),
(53, 'NET NUMBER OF SAMPLES WITH ANALYSTS, REVIEWERS ETC', 'Documentation Unit needs to track analysts'' and reviewers'' reports as and when need arises. Of importance is info on the number of samples pending with analysts between a selected period, i.e. the net number of samples that have not been returned to Documentation. Please treat this as urgent.', '2015-07-10 09:03:22', 'Dr.Rebecca Manani', '0000-00-00', 94, 'Watson', '', 0),
(54, 'REDUCING BALANCES i.e ITEMS/REAGENTS RECEIVED ', 'Kindly om the column of issuance,please let me know my BALANCES at just a glance.This will help me know the level of my stock and institute\r\nappropriate measures,\r\nRgds\r\nWilson/Procurement', '2015-08-03 08:26:30', 'Mr.Wilson Onyango', '0000-00-00', 104, 'Watson', '', 0),
(55, 'Error on Identification platform', 'When I adjust the figures in the identification platform the changes are not effected.', '2015-08-05 10:04:58', 'Dr.George Wang''ang''a', '2015-08-06', 107, 'Alphonce', 'On identification, use the drop down and select run 1 or 2 if there was a repeat. Now check the bottom of the page you will see update. Update any field you want then click the update button. Then you can now go and approve. ', 1),
(56, 'Rejecting downloaded workbook', 'In case of errors in worksheet picked up by the supervisor (e.g. assay stage) there needs to be a provision to reject the workbook and send it back to the analyst.', '2015-08-25 06:30:55', 'Dr.Matthew Kwena', '2015-10-07', 93, 'Alphonce', 'reject was enabled', 1),
(57, 'weight variation', 'not able to download weight variation w/sheet', '2015-09-01 07:10:45', 'Dr.Eric Mutua', '2015-09-07', 84, 'Alphonce', 'The worksheet was uploaded', 1),
(58, 'Supervisor Review', '1. Supervisor should be able to upload a reviewed and corrected worksheet and not just approve.\r\n2. When clicking "Download worksheet" option, a Wetchem excel worksheet is downloaded instead of Microbiology one.', '2015-09-04 09:56:47', 'Dr.Emmanuel Tanui', '2015-09-07', 77, 'Alphonce', 'I have worked on the above Issue, I will be waiting for your feedback if the system does as you requested', 1),
(59, 'Upload Error', 'Sample Worksheet does not disappear once an edited excel sheet is uploaded. Therefore its not accessible by documentation unit for drafting of certificate', '2015-09-09 06:31:58', 'Dr.Emmanuel Tanui', '2015-09-10', 77, 'Alphonce', 'Kindly click the approve link after you have carried out the upload as i work on the automatic upload on upload. If there is still a problem you can reopen the issue', 1),
(60, 'Sample issued not on my List', 'dipifer Syrup NDQD201404404 has been issued but is not the list for samples issued to Sarah Mwangi', '2015-09-15 11:05:27', 'Dr.Sarah Mwangi', '0000-00-00', 52, 'Watson', '', 0),
(61, 'INCREASEDB WORK LOAD', 'SYSTEM IS TOO REPETITIVE HENCE INCREASING WORK LOAD', '2015-09-24 15:55:09', 'Dr.Eric Mutua', '0000-00-00', 84, 'Watson', '', 0),
(62, 'Multiple Preparations per Sample Reporting', 'Certain samples contain diluents which are tested as separate preparations especially for sterility, microbial load, preservative efficacy and Endotoxin tests. They even carry individual batch numbers that are different from each other. Kindly enable us to report their test outcome using different worksheets under the same NDQ.. code.\r\n\r\nIn the case of microbial assay, individual antibiotic ingredient call for a different test to be carried using different microbes. Kindly help us report these results.', '2015-10-08 10:52:28', 'Mr.Eric Ngamau', '0000-00-00', 86, 'Alphonce', '', 0),
(63, 'Reagents and Equipment', 'Most reagents and equipment used in the BAU are not reflecting in the LIMS and have to be entered in the worksheets by hand.', '2015-10-08 10:56:46', 'Mr.Eric Ngamau', '0000-00-00', 86, 'Watson', '', 0),
(64, 'DUPLICATED LIMITS ', 'THERE ARE VARIOUS DIALOGUE BOXES ASKING THE LIMITS AND SPECIFICATIONS OF A SAMPLE. MORE WORKLOAD', '2015-11-16 09:15:48', 'Dr.Joyfrida Chepchumba', '0000-00-00', 83, 'Watson', '', 0),
(65, 'worksheets not approving', 'As a supervisor I''ve been unable to approve worksheets so as to forward to documentation for purposes of review issuance. NDQA201508086/172/031', '2015-12-14 13:14:50', 'Dr.George Wang''ang''a', '2015-12-16', 107, 'Alphonce', 'This was sorted Yesterday', 1),
(66, 'Uploading', 'Worksheet not uploading after review NDQD201508175, & 178, 181', '2015-12-15 12:40:29', 'Dr.George Wang''ang''a', '2015-12-16', 107, 'Alphonce', 'Kindly refer to standard sheet numbering, The worksheet should have number 10 instead of 1 and try again', 1),
(67, 'Sample with two numbers', 'Diclofenac Sodium Injection has two numbers, NDQD201507032 and NDQB201407032', '2015-12-21 12:20:39', 'Dr.Ernest Mbae', '0000-00-00', 57, 'Alphonce', '', 0),
(68, 'COA drafting ', 'Client details chnaged in one has been picked by all others yet only 3 coas are for KEMSA', '2016-07-19 15:09:06', 'Dr.George Wang''ang''a', '0000-00-00', 107, 'Alphonce', '', 0),
(69, 'COA Drafting page', 'Kindly add a drop down menu for the section of add signatory for all reviewers/drafters and a date menu', '2016-11-25 06:14:27', 'Dr.George Wang''ang''a', '0000-00-00', 107, 'Alphonce', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
