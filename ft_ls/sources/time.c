/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   time.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/04/01 14:10:33 by malallai          #+#    #+#             */
/*   Updated: 2019/05/11 19:10:18 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "../ft_ls.h"

static char		*get_finaldate(time_t date, char *file_time, \
		char *base_time)
{
	char		*base_time_alt;
	char		*tmp;
	long int	current_time;
	char		*final_time;

	current_time = time(0);
	if ((date > current_time) || (date < (current_time - 15724800)))
	{
		base_time_alt = ft_strjoin(base_time, " ");
		tmp = ft_strsub(file_time, 19, 5);
		final_time = ft_strjoin(base_time_alt, tmp);
		free(base_time_alt);
	}
	else
	{
		tmp = ft_strsub(file_time, 10, 6);
		final_time = ft_strjoin(base_time, tmp);
	}
	free(tmp);
	return (final_time);
}

char			*get_date(time_t date)
{
	char		*base_time;
	char		*file_time;
	char		*final_time;

	file_time = ft_strdup(ctime(&date));
	base_time = ft_strsub(file_time, 4, 6);
	final_time = get_finaldate(date, file_time, base_time);
	free(file_time);
	free(base_time);
	return (final_time);
}
